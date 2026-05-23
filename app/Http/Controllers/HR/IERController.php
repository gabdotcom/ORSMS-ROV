<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;

class IERController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'hr') {
            return redirect('/' . auth()->user()->role . '/dashboard');
        }

        $jobPostings = JobPosting::with('plantillaPosition')
            ->whereHas('applications', function ($q) {
                $q->whereIn('status', ['qualified', 'disqualified']);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $applications = collect();
        $selectedJob = null;

        if ($request->filled('job_id')) {
            $selectedJob = JobPosting::with('plantillaPosition')->findOrFail($request->job_id);
            $applications = Application::with([
                'user.applicantProfile',
                'sectorEvaluations',
                'educations',
                'trainings',
                'experiences',
                'eligibilities.eligibilityType',
            ])
                ->where('job_id', $request->job_id)
                ->whereIn('status', ['qualified', 'disqualified'])
                ->orderBy('created_at')
                ->get();
        }

        return view('hr.ier', compact('jobPostings', 'applications', 'selectedJob'));
    }
}
