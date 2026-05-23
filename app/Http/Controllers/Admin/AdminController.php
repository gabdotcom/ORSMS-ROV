<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function checkAdminRole()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    public function dashboard()
    {
        $this->checkAdminRole();

        $totalUsers = User::count();
        $applicantCount = User::where('role', 'applicant')->count();
        $hrCount = User::where('role', 'hr')->count();
        $boardCount = User::where('role', 'board')->count();
        $adminCount = User::where('role', 'admin')->count();
        $pendingUsers = User::where('status', 'pending')->count();
        $activeUsers = User::where('status', 'active')->count();

        $openPositions = JobPosting::where('status', 'open')->count();
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $qualifiedApplications = Application::where('status', 'qualified')->count();

        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();
        $recentJobs = JobPosting::with('plantillaPosition')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'applicantCount',
            'hrCount',
            'boardCount',
            'adminCount',
            'pendingUsers',
            'activeUsers',
            'openPositions',
            'totalApplications',
            'pendingApplications',
            'qualifiedApplications',
            'recentUsers',
            'recentJobs'
        ));
    }

    public function users(Request $request)
    {
        $this->checkAdminRole();

        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $this->checkAdminRole();

        $request->validate(['role' => 'required|in:applicant,hr,board,admin']);

        $user->update(['role' => $request->role]);

        return back()->with('success', "{$user->first_name} {$user->last_name} role updated to " . ucfirst($request->role));
    }

    public function updateStatus(Request $request, User $user)
    {
        $this->checkAdminRole();

        $request->validate(['status' => 'required|in:pending,active,inactive,suspended']);

        $user->update(['status' => $request->status]);

        return back()->with('success', "{$user->first_name} {$user->last_name} status updated to " . ucfirst($request->status));
    }
}
