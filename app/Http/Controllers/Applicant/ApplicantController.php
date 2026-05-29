<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Application;
use App\Models\ApplicantProfile;
use App\Models\DocumentType;
use App\Models\EligibilityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    private function checkApplicantRole()
    {
        if (auth()->user()->role !== 'applicant') {
            abort(403, 'Unauthorized');
        }
    }

    private function formatApplicationDates($application)
    {
        // Format experiences - convert to array
        if ($application->experiences) {
            $application->experiences = $application->experiences->map(function($exp) {
                return [
                    'id' => $exp->id,
                    'position' => $exp->position,
                    'employer' => $exp->employer,
                    'start_date' => $exp->start_date ? $exp->start_date->format('Y-m-d') : null,
                    'end_date' => $exp->end_date ? $exp->end_date->format('Y-m-d') : null,
                    'is_present' => $exp->is_present,
                    'sector' => $exp->sector,
                    'file_path' => $exp->file_path,
                ];
            })->values()->all();
        }

        // Format trainings - convert to array
        if ($application->trainings) {
            $application->trainings = $application->trainings->map(function($train) {
                return [
                    'id' => $train->id,
                    'training_title' => $train->training_title,
                    'training_hours' => $train->training_hours,
                    'date_conducted' => $train->date_conducted ? $train->date_conducted->format('Y-m-d') : null,
                    'file_path' => $train->file_path,
                ];
            })->values()->all();
        }

        // Format eligibilities - convert to array
        if ($application->eligibilities) {
            $application->eligibilities = $application->eligibilities->map(function($elig) {
                return [
                    'id' => $elig->id,
                    'eligibility_type_id' => $elig->eligibility_type_id,
                    'eligibility_type' => $elig->eligibility_type ? [
                        'id' => $elig->eligibility_type->id,
                        'name' => $elig->eligibility_type->name,
                    ] : null,
                    'other_name' => $elig->other_name,
                    'license_no' => $elig->license_no,
                    'date_issued' => $elig->date_issued ? $elig->date_issued->format('Y-m-d') : null,
                    'file_path' => $elig->file_path,
                ];
            })->values()->all();
        }

        // Format educations - convert to array
        if ($application->educations) {
            $application->educations = $application->educations->map(function($edu) {
                return [
                    'id' => $edu->id,
                    'level' => $edu->level,
                    'school_name' => $edu->school_name,
                    'course' => $edu->course,
                    'year_graduated' => $edu->year_graduated,
                    'file_path' => $edu->file_path,
                ];
            })->values()->all();
        }

        return $application;
    }

    public function dashboard()
    {
        $this->checkApplicantRole();
        $userId = auth()->id();

        $applications = Application::with('job.plantillaPosition')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $applications->count(),
            'pending' => $applications->where('status', 'pending')->count(),
            'qualified' => $applications->where('status', 'qualified')->count(),
            'disqualified' => $applications->where('status', 'disqualified')->count(),
        ];

        return view('applicant.dashboard', compact('applications', 'stats'));
    }

    public function jobs()
    {
        $this->checkApplicantRole();
        $userId = auth()->id();

        $jobPostings = JobPosting::with('plantillaPosition')
            ->withCount('applications')
            ->where('status', 'open')
            ->where('deadline', '>', now())
            ->orderBy('posted_at', 'desc')
            ->get();

        $appliedJobIds = Application::where('user_id', $userId)->pluck('job_id')->toArray();

        return view('applicant.jobs', compact('jobPostings', 'appliedJobIds'));
    }

    public function apply(JobPosting $jobPosting)
    {
        $this->checkApplicantRole();
        $userId = auth()->id();

        $existingApplication = Application::where('user_id', $userId)
            ->where('job_id', $jobPosting->id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('applicant.jobs')->with('error', 'You have already applied for this job.');
        }

        $profile = ApplicantProfile::where('user_id', $userId)->first();
        $documentTypes = DocumentType::where('is_active', true)->get();
        $eligibilityTypes = EligibilityType::where('is_active', true)->get();

        return view('applicant.apply', compact('jobPosting', 'profile', 'documentTypes', 'eligibilityTypes'));
    }

    public function getApplyForm(JobPosting $jobPosting)
    {
        $this->checkApplicantRole();
        $userId = auth()->id();

        $existingApplication = Application::where('user_id', $userId)
            ->where('job_id', $jobPosting->id)
            ->first();

        if ($existingApplication) {
            return response()->json(['error' => 'You have already applied for this job.'], 400);
        }

        $profile = ApplicantProfile::where('user_id', $userId)->first();
        
        // Only load document types that are required for this job posting
        $jobRequirements = $jobPosting->requirements ?? [];
        $documentTypes = DocumentType::where('is_active', true)
            ->whereIn('id', $jobRequirements)
            ->get();
        $eligibilityTypes = EligibilityType::where('is_active', true)->get();

        return view('applicant.apply-form', compact('jobPosting', 'profile', 'documentTypes', 'eligibilityTypes'))->render();
    }

    public function storeApplication(Request $request, JobPosting $jobPosting = null)
    {
        $this->checkApplicantRole();
        $userId = auth()->id();

        // Fallback to job_id from form input if route binding fails
        $jobId = $jobPosting ? $jobPosting->id : $request->input('job_id');
        
        if (!$jobId) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Job not found.'], 400);
            }
            return redirect()->route('applicant.jobs')->with('error', 'Job not found.');
        }

        $existingApplication = Application::where('user_id', $userId)
            ->where('job_id', $jobId)
            ->first();

        if ($existingApplication) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You have already applied for this job.'], 400);
            }
            return redirect()->route('applicant.jobs')->with('error', 'You have already applied for this job.');
        }

        $validated = $request->validate([
            'job_id' => 'required|exists:job_postings,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'extension_name' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'civil_status' => 'nullable|in:Single,Married,Widowed,Separated,Annulled',
            'citizenship' => 'nullable|string|max:100',
            'contact_number' => 'nullable|string|max:20',
            'region' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'current_address' => 'nullable|string',
            'educations' => 'nullable|array',
            'trainings' => 'nullable|array',
            'experiences' => 'nullable|array',
            'eligibilities' => 'nullable|array',
            'documents' => 'nullable|array',
        ]);

        $profile = ApplicantProfile::updateOrCreate(
            ['user_id' => $userId],
            [
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'civil_status' => $validated['civil_status'] ?? null,
                'citizenship' => $validated['citizenship'] ?? null,
                'contact_number' => $validated['contact_number'] ?? null,
                'region' => $validated['region'] ?? null,
                'province' => $validated['province'] ?? null,
                'city' => $validated['city'] ?? null,
                'municipality' => $validated['municipality'] ?? null,
                'barangay' => $validated['barangay'] ?? null,
                'zip_code' => $validated['zip_code'] ?? null,
                'current_address' => $validated['current_address'] ?? null,
                'is_person_with_disability' => $request->has('is_person_with_disability') ? 1 : 0,
                'is_solo_parent' => $request->has('is_solo_parent') ? 1 : 0,
                'is_member_of_indigenous_people' => $request->has('is_member_of_indigenous_people') ? 1 : 0,
            ]
        );

        $job = JobPosting::with('plantillaPosition')->find($jobId);
        $positionCode = $job->plantillaPosition->position_code ?? 'APP';
        $year = date('Y');
        $lastApplication = Application::where('application_code', 'like', "$positionCode-$year-%")
            ->orderBy('application_code', 'desc')
            ->first();
        $sequence = $lastApplication ? intval(substr($lastApplication->application_code, -3)) + 1 : 1;
        $applicationCode = sprintf('%s-%s-%03d', $positionCode, $year, $sequence);

        $application = Application::create([
            'application_code' => $applicationCode,
            'user_id' => $userId,
            'job_id' => $jobId,
            'status' => 'pending',
        ]);

        if (!empty($validated['educations'])) {
            foreach ($validated['educations'] as $edu) {
                $application->educations()->create([
                    'level' => $edu['level'] ?? 'Bachelors',
                    'school_name' => $edu['school_name'] ?? '',
                    'course' => $edu['course'] ?? null,
                    'units_completed' => $edu['units_completed'] ?? null,
                    'year_graduated' => $edu['year_graduated'] ?? null,
                    'file_path' => $this->handleUpload($edu['file'] ?? null, 'education'),
                ]);
            }
        }

        if (!empty($validated['trainings'])) {
            foreach ($validated['trainings'] as $train) {
                $application->trainings()->create([
                    'training_title' => $train['training_title'] ?? '',
                    'training_hours' => $train['training_hours'] ?? null,
                    'date_conducted' => $train['date_conducted'] ?? null,
                    'file_path' => $this->handleUpload($train['file'] ?? null, 'training'),
                ]);
            }
        }

        if (!empty($validated['experiences'])) {
            foreach ($validated['experiences'] as $exp) {
                $application->experiences()->create([
                    'employer' => $exp['employer'] ?? '',
                    'position' => $exp['position'] ?? '',
                    'start_date' => $exp['start_date'] ?? null,
                    'end_date' => $exp['end_date'] ?? null,
                    'is_present' => $exp['is_present'] ?? false,
                    'sector' => $exp['sector'] ?? null,
                    'file_path' => $this->handleUpload($exp['file'] ?? null, 'experience'),
                ]);
            }
        }

        if (!empty($validated['eligibilities'])) {
            foreach ($validated['eligibilities'] as $elig) {
                $application->eligibilities()->create([
                    'eligibility_type_id' => $elig['eligibility_type_id'] ?? null,
                    'other_name' => $elig['other_name'] ?? null,
                    'license_no' => $elig['license_no'] ?? null,
                    'date_issued' => $elig['date_issued'] ?? null,
                    'file_path' => $this->handleUpload($elig['file'] ?? null, 'eligibility'),
                ]);
            }
        }

        if (!empty($validated['documents'])) {
            foreach ($validated['documents'] as $docTypeId => $doc) {
                if (!empty($doc['file'])) {
                    $application->documents()->create([
                        'document_type_id' => $docTypeId,
                        'file_path' => $this->handleUpload($doc['file'], 'documents'),
                        'uploaded_at' => now(),
                    ]);
                }
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
                'application_code' => $applicationCode,
                'redirect' => route('applicant.dashboard')
            ]);
        }

        return redirect()->route('applicant.dashboard')->with('success', 'Application submitted successfully! Your application code is: ' . $applicationCode);
    }

    public function withdraw(Application $application)
    {
        $this->checkApplicantRole();

        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($application->status !== 'pending') {
            return back()->with('error', 'Cannot withdraw application that is already processed.');
        }

        foreach ($application->educations as $edu) {
            if ($edu->file_path) Storage::disk('public')->delete($edu->file_path);
        }
        foreach ($application->trainings as $train) {
            if ($train->file_path) Storage::disk('public')->delete($train->file_path);
        }
        foreach ($application->experiences as $exp) {
            if ($exp->file_path) Storage::disk('public')->delete($exp->file_path);
        }
        foreach ($application->eligibilities as $elig) {
            if ($elig->file_path) Storage::disk('public')->delete($elig->file_path);
        }
        foreach ($application->documents as $doc) {
            if ($doc->file_path) Storage::disk('public')->delete($doc->file_path);
        }

        $application->educations()->delete();
        $application->trainings()->delete();
        $application->experiences()->delete();
        $application->eligibilities()->delete();
        $application->documents()->delete();
        $application->delete();

        return redirect()->route('applicant.dashboard')->with('success', 'Application withdrawn successfully.');
    }

    public function profile()
    {
        $this->checkApplicantRole();
        $profile = ApplicantProfile::where('user_id', auth()->id())->first();
        return view('applicant.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $this->checkApplicantRole();
        $validated = $request->validate([
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'civil_status' => 'nullable|in:Single,Married,Widowed,Separated,Annulled',
            'citizenship' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:100',
            'contact_number' => 'nullable|string|max:20',
            'region' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'current_address' => 'nullable|string',
            'is_person_with_disability' => 'nullable|boolean',
            'is_solo_parent' => 'nullable|boolean',
            'is_member_of_indigenous_people' => 'nullable|boolean',
        ]);

        foreach (['is_person_with_disability', 'is_solo_parent', 'is_member_of_indigenous_people'] as $field) {
            $validated[$field] = $request->has($field) ? 1 : 0;
        }

        ApplicantProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return back()->with('success', 'Profile updated successfully.');
    }

    private function handleUpload($file, $folder)
    {
        if (!$file) return null;
        try {
            return $file->store($folder, 'public');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function viewApplication(Application $application)
    {
        $this->checkApplicantRole();
        
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $application->load([
            'user',
            'job.plantillaPosition',
            'educations',
            'trainings',
            'experiences',
            'eligibilities',
            'documents.documentType',
            'sectorEvaluations.evaluatedBy',
            'reviewedBy',
        ]);

        if (request()->expectsJson()) {
            return response()->json($application);
        }

        return view('applicant.view-application', compact('application'));
    }

    public function editApplication(Application $application)
    {
        $this->checkApplicantRole();
        
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($application->status !== 'pending') {
            return response()->json(['error' => 'Application is locked and cannot be edited.'], 403);
        }

        $application->load([
            'job.plantillaPosition', 
            'educations', 
            'trainings', 
            'experiences', 
            'eligibilities.eligibilityType', 
            'documents.documentType'
        ]);

        // Format dates for JSON response
        $application = $this->formatApplicationDates($application);
        
        // Convert to array with formatted relations
        $appArray = $application->toArray();
        
        // Add formatted relationships
        if (isset($application->experiences)) {
            $appArray['experiences'] = $application->experiences;
        }
        if (isset($application->trainings)) {
            $appArray['trainings'] = $application->trainings;
        }
        if (isset($application->eligibilities)) {
            $appArray['eligibilities'] = $application->eligibilities;
        }
        if (isset($application->educations)) {
            $appArray['educations'] = $application->educations;
        }
        
        $eligibilityTypes = EligibilityType::where('is_active', true)->get();

        if (request()->expectsJson()) {
            return response()->json(['application' => $appArray, 'eligibilityTypes' => $eligibilityTypes]);
        }

        return view('applicant.edit-application', compact('application'));
    }

    public function updateApplication(Request $request, Application $application)
    {
        $this->checkApplicantRole();
        
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

if ($application->status !== 'pending') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Application is locked and cannot be edited.'], 403);
            }
            return back()->with('error', 'Application is locked and cannot be edited.');
        }

        // Handle Education
        if ($request->has('educations')) {
            foreach ($request->educations as $eduData) {
                $filePath = null;
                if (isset($eduData['file']) && $eduData['file']) {
                    $filePath = $this->handleUpload($eduData['file'], 'education');
                }
                
                $updateData = [
                    'level' => $eduData['level'],
                    'school_name' => $eduData['school_name'],
                    'course' => $eduData['course'] ?? null,
                    'year_graduated' => $eduData['year_graduated'] ?? null,
                ];
                if ($filePath) {
                    $updateData['file_path'] = $filePath;
                }

                if (isset($eduData['id']) && $eduData['id']) {
                    $application->educations()->where('id', $eduData['id'])->update($updateData);
                } else {
                    $application->educations()->create($updateData);
                }
            }
        }

        // Handle Training
        if ($request->has('trainings')) {
            foreach ($request->trainings as $trainData) {
                $filePath = null;
                if (isset($trainData['file']) && $trainData['file']) {
                    $filePath = $this->handleUpload($trainData['file'], 'training');
                }
                
                $updateData = [
                    'training_title' => $trainData['training_title'],
                    'training_hours' => $trainData['training_hours'] ?? null,
                    'date_conducted' => $trainData['date_conducted'] ?? null,
                ];
                if ($filePath) {
                    $updateData['file_path'] = $filePath;
                }

                if (isset($trainData['id']) && $trainData['id']) {
                    $application->trainings()->where('id', $trainData['id'])->update($updateData);
                } else {
                    $application->trainings()->create($updateData);
                }
            }
        }

        // Handle Experience
        if ($request->has('experiences')) {
            foreach ($request->experiences as $expData) {
                if (empty($expData['employer']) || empty($expData['position']) || empty($expData['start_date'])) {
                    continue; // Skip if required fields are missing
                }

                $filePath = null;
                if (isset($expData['file']) && $expData['file']) {
                    $filePath = $this->handleUpload($expData['file'], 'experience');
                }
                
                $updateData = [
                    'employer' => $expData['employer'],
                    'position' => $expData['position'],
                    'start_date' => $expData['start_date'],
                    'end_date' => $expData['end_date'] ?? null,
                    'is_present' => isset($expData['is_present']) && $expData['is_present'],
                    'sector' => $expData['sector'] ?? null,
                ];
                if ($filePath) {
                    $updateData['file_path'] = $filePath;
                }

                if (isset($expData['id']) && $expData['id']) {
                    $application->experiences()->where('id', $expData['id'])->update($updateData);
                } else {
                    $application->experiences()->create($updateData);
                }
            }
        }

        // Handle Eligibility
        if ($request->has('eligibilities')) {
            foreach ($request->eligibilities as $eligData) {
                $filePath = null;
                if (isset($eligData['file']) && $eligData['file']) {
                    $filePath = $this->handleUpload($eligData['file'], 'eligibility');
                }
                
                $updateData = [
                    'eligibility_type_id' => $eligData['eligibility_type_id'] ?? null,
                    'other_name' => $eligData['other_name'] ?? null,
                    'license_no' => $eligData['license_no'] ?? null,
                    'date_issued' => $eligData['date_issued'] ?? null,
                ];
                if ($filePath) {
                    $updateData['file_path'] = $filePath;
                }

                if (isset($eligData['id']) && $eligData['id']) {
                    $application->eligibilities()->where('id', $eligData['id'])->update($updateData);
                } else {
                    $application->eligibilities()->create($updateData);
                }
            }
        }

        // Handle Documents (Other Requirements)
        if ($request->has('documents')) {
            foreach ($request->documents as $docData) {
                if (!isset($docData['document_type_id'])) continue;
                
                $filePath = null;
                if (isset($docData['file']) && $docData['file']) {
                    $filePath = $this->handleUpload($docData['file'], 'documents');
                }

                $updateData = [];
                if ($filePath) {
                    $updateData['file_path'] = $filePath;
                    $updateData['uploaded_at'] = now();
                }

                if (!empty($updateData)) {
                    if (isset($docData['id']) && $docData['id']) {
                        $application->documents()->where('id', $docData['id'])->update($updateData);
                    }
                }
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Application updated successfully.']);
        }
        return back()->with('success', 'Application updated successfully.');
    }

    public function deleteEntry(Request $request, Application $application)
    {
        $this->checkApplicantRole();
        
        if ($application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($application->status !== 'pending') {
            return response()->json(['error' => 'Application is locked and cannot be edited.'], 403);
        }

        $type = $request->input('type');
        $entryId = $request->input('id');

        $allowedTypes = ['education', 'training', 'experience', 'eligibility'];
        if (!in_array($type, $allowedTypes)) {
            return response()->json(['error' => 'Invalid entry type'], 400);
        }

        $relationshipMap = [
            'education' => 'educations',
            'training' => 'trainings',
            'experience' => 'experiences',
            'eligibility' => 'eligibilities',
        ];

        $relationship = $relationshipMap[$type];
        $entry = $application->$relationship()->where('id', $entryId)->first();

        if ($entry) {
            $entry->delete();
            return response()->json(['success' => true, 'message' => 'Entry deleted successfully.']);
        }

        return response()->json(['error' => 'Entry not found'], 404);
    }
}