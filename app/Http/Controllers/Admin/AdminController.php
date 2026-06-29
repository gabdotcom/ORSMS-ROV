<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function show(User $user)
    {
        $this->checkAdminRole();

        $user->loadCount('applications');

        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'extension_name' => $user->extension_name,
            'email' => $user->email,
            'role' => $user->role,
            'status' => $user->status,
            'applications_count' => $user->applications_count,
            'created_at' => $user->created_at->format('M d, Y \a\t h:i A'),
            'updated_at' => $user->updated_at->format('M d, Y \a\t h:i A'),
        ]);
    }

    public function resetPassword(Request $request, User $user)
    {
        $this->checkAdminRole();

        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $message = "Password for {$user->first_name} {$user->last_name} has been reset.";

        if ($request->expectsJson()) {
            return response()->json(['message' => $message]);
        }

        return back()->with('success', $message);
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
