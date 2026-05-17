<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;

class HRDashboardController extends Controller
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

        // Stats
        $openPositions = JobPosting::where('status', 'open')->count();
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $qualifiedApplications = Application::where('status', 'qualified')->count();

        // Recent job postings
        $recentJobs = JobPosting::with('plantillaPosition', 'applications')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent applications
        $recentApplications = Application::with('user', 'job.plantillaPosition')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Monthly application stats
        $thisMonthApplications = Application::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthApplications = Application::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $changePercent = $lastMonthApplications > 0 
            ? round((($thisMonthApplications - $lastMonthApplications) / $lastMonthApplications) * 100)
            : 0;

        return view('hr.dashboard', compact(
            'openPositions',
            'totalApplications',
            'pendingApplications',
            'qualifiedApplications',
            'recentJobs',
            'recentApplications',
            'thisMonthApplications',
            'changePercent'
        ));
    }
}