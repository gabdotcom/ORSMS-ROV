<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\PlantillaPosition;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobPostingsController extends Controller
{
    private function checkHrRole()
    {
        if (auth()->user()->role !== 'hr') {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $this->checkHrRole();
        $jobPostings = JobPosting::with('plantillaPosition', 'applications')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('hr.job-postings', compact('jobPostings'));
    }

    public function store(Request $request)
    {
        $this->checkHrRole();
        $validated = $request->validate([
            'plantilla_position_id' => 'required|exists:plantilla_positions,id',
            'monthly_salary' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'required_education' => 'nullable|string',
            'required_training' => 'nullable|string',
            'required_experience' => 'nullable|string',
            'required_eligibility' => 'nullable|string',
            'requirements' => 'nullable|array',
            'deadline' => 'required|date',
            'status' => 'required|in:draft,open,closed',
            'posted_at' => 'nullable|date',
            'job_description_pdf' => 'nullable|file|mimes:pdf',
        ]);

        // Handle requirements - get raw input to ensure we capture all states
        $rawRequirements = $request->all()['requirements'] ?? [];
        $validated['requirements'] = is_array($rawRequirements) ? $rawRequirements : [];

        if ($request->hasFile('job_description_pdf')) {
            try {
                $path = $request->file('job_description_pdf')->store('job-descriptions', 'public');
                $validated['job_description_pdf'] = $path;
            } catch (\Exception $e) {
                return back()->with('error', 'PDF upload failed: ' . $e->getMessage());
            }
        }

        if ($validated['status'] === 'open' && empty($validated['posted_at'])) {
            $validated['posted_at'] = now();
        }

        JobPosting::create($validated);

        return redirect()->route('hr.job-postings')->with('success', 'Job posting created successfully.');
    }

    public function update(Request $request, JobPosting $jobPosting)
    {
        $this->checkHrRole();
        $validated = $request->validate([
            'plantilla_position_id' => 'required|exists:plantilla_positions,id',
            'monthly_salary' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'required_education' => 'nullable|string',
            'required_training' => 'nullable|string',
            'required_experience' => 'nullable|string',
            'required_eligibility' => 'nullable|string',
            'requirements' => 'nullable|array',
            'deadline' => 'required|date',
            'status' => 'required|in:draft,open,closed',
            'posted_at' => 'nullable|date',
            'job_description_pdf' => 'nullable|file|mimes:pdf',
        ]);

        // Handle requirements - get raw input to ensure we capture unchecked state
        // When checkboxes are unchecked, they're not sent in form data
        // So we need to explicitly get the array from input
        $rawRequirements = $request->all()['requirements'] ?? [];
        $validated['requirements'] = is_array($rawRequirements) ? $rawRequirements : [];

        if ($request->hasFile('job_description_pdf')) {
            if ($jobPosting->job_description_pdf) {
                Storage::disk('public')->delete($jobPosting->job_description_pdf);
            }
            $path = $request->file('job_description_pdf')->store('job-descriptions', 'public');
            $validated['job_description_pdf'] = $path;
        }

        $oldStatus = $jobPosting->status;
        $newStatus = $validated['status'];

        if ($oldStatus !== 'open' && $newStatus === 'open' && empty($jobPosting->posted_at)) {
            $validated['posted_at'] = now();
        }

        $jobPosting->update($validated);

        // Debug: Check what's actually saved
        \Log::info('Updated requirements:', ['requirements' => $jobPosting->fresh()->requirements]);

        return redirect()->route('hr.job-postings')->with('success', 'Job posting updated successfully.');
    }

    public function destroy(JobPosting $jobPosting)
    {
        $this->checkHrRole();
        if ($jobPosting->job_description_pdf) {
            Storage::disk('public')->delete($jobPosting->job_description_pdf);
        }
        $jobPosting->delete();

        return redirect()->route('hr.job-postings')->with('success', 'Job posting deleted successfully.');
    }

    public function getDepartments()
    {
        $departments = PlantillaPosition::where('is_active', true)
            ->distinct()
            ->pluck('department');

        return response()->json($departments);
    }

    public function getPositions(Request $request)
    {
        $positions = PlantillaPosition::where('is_active', true)
            ->where('department', $request->department)
            ->get(['id', 'position_name', 'position_code', 'salary_grade']);

        return response()->json($positions);
    }

    public function getPositionDetails(Request $request)
    {
        $position = PlantillaPosition::findOrFail($request->position_id);

        return response()->json([
            'position_name' => $position->position_name,
            'position_code' => $position->position_code,
            'salary_grade' => $position->salary_grade,
        ]);
    }

    public function getDocumentTypes()
    {
        $documentTypes = DocumentType::where('is_active', true)->get();

        return response()->json($documentTypes);
    }
}