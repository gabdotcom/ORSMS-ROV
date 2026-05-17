<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPosting;
use App\Models\SectorEvaluation;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    private function checkHrRole()
    {
        if (auth()->user()->role !== 'hr') {
            abort(403, 'Unauthorized');
        }
    }

    public function index(Request $request)
    {
        $this->checkHrRole();

        $query = Application::with([
            'user', 
            'job.plantillaPosition',
            'sectorEvaluations'
        ]);

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->job_id && $request->job_id !== 'all') {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->orderBy('created_at', 'desc')->get();
        $jobPostings = JobPosting::with('plantillaPosition')
            ->where('status', 'open')
            ->orWhere('status', 'closed')
            ->get();

        return view('hr.applications', compact('applications', 'jobPostings'));
    }

    public function show(Application $application)
    {
        $this->checkHrRole();
        
        $application->load(['user', 'job.plantillaPosition', 'educations', 'trainings', 'experiences', 'eligibilities', 'documents', 'sectorEvaluations']);
        
        return view('hr.application-detail', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->checkHrRole();

        $validated = $request->validate([
            'status' => 'required|in:pending,qualified,disqualified',
            'hr_notes' => 'nullable|string',
        ]);

        $application->update([
            'status' => $validated['status'],
            'hr_notes' => $validated['hr_notes'] ?? null,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Application status updated successfully.');
    }

    public function storeSectorEvaluation(Request $request, Application $application)
    {
        $this->checkHrRole();

        $sectors = $request->input('sectors', []);
        
        foreach (['education', 'training', 'experience', 'eligibility'] as $sector) {
            if (isset($sectors[$sector])) {
                $sectorData = $sectors[$sector];
                SectorEvaluation::updateOrCreate(
                    [
                        'application_id' => $application->id,
                        'sector' => $sector,
                    ],
                    [
                        'status' => $sectorData['status'] ?? 'disqualified',
                        'remarks' => $sectorData['remarks'] ?? null,
                        'evaluated_by' => auth()->id(),
                        'evaluated_at' => now(),
                    ]
                );
            }
        }

        return back()->with('success', 'Sector evaluations saved successfully.');
    }

    public function getApplicationDetails(Application $application)
    {
        $this->checkHrRole();
        
        $application->load([
            'user',
            'job.plantillaPosition',
            'educations',
            'trainings',
            'experiences',
            'eligibilities',
            'documents.documentType',
            'sectorEvaluations'
        ]);

        return response()->json([
            'application' => $application,
            'sectorEvaluations' => $application->sectorEvaluations->keyBy('sector'),
        ]);
    }
}