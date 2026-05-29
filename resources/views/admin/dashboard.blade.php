@extends('layouts.admin')
@section('title', 'Admin Dashboard - DEPED Region V Recruitment')
@push('styles')
<style>
.stat-sub.success { color: var(--color-semantic-success); }
.stat-sub.warning { color: var(--color-semantic-warning); }
.stat-sub.error { color: var(--color-semantic-error); }
.badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
</style>
@endpush
@section('content')
<div class="page-header mb-lg">
    <h1 class="text-2xl font-semibold mb-1">Admin Dashboard</h1>
    <p class="text-sm text-body">System overview and user management</p>
</div>

<div class="grid grid-cols-4 gap-5 mb-8 max-lg:grid-cols-2">
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Total Users</div>
        <div class="text-[28px] font-semibold">{{ $totalUsers }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Applicants</div>
        <div class="text-[28px] font-semibold">{{ $applicantCount }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Open Positions</div>
        <div class="text-[28px] font-semibold">{{ $openPositions }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Pending Review</div>
        <div class="text-[28px] font-semibold">{{ $pendingApplications }}</div>
    </div>
</div>

<div class="grid grid-cols-4 gap-5 mb-8 max-lg:grid-cols-2">
    <div class="bg-surface-card border border-hairline rounded-lg p-5" style="border-left: 3px solid #1e40af;">
        <div class="text-[13px] text-muted mb-1">Applicants</div>
        <div class="text-[28px] font-semibold">{{ $applicantCount }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5" style="border-left: 3px solid #166534;">
        <div class="text-[13px] text-muted mb-1">HR Staff</div>
        <div class="text-[28px] font-semibold">{{ $hrCount }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5" style="border-left: 3px solid #92400e;">
        <div class="text-[13px] text-muted mb-1">Board Members</div>
        <div class="text-[28px] font-semibold">{{ $boardCount }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5" style="border-left: 3px solid #7c3aed;">
        <div class="text-[13px] text-muted mb-1">Admins</div>
        <div class="text-[28px] font-semibold">{{ $adminCount }}</div>
    </div>
</div>

<div class="grid grid-cols-2 gap-lg max-lg:grid-cols-1">
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold">Recent Users</h2>
            <a href="{{ route('admin.users') }}" class="text-sm text-primary no-underline hover:underline">Manage Users</a>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Name</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Email</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Role</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $user)
                <tr class="hover:bg-canvas-soft transition-colors">
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $user->email }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline"><span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background:var(--color-role-{{ $user->role }}-bg);color:var(--color-role-{{ $user->role }}-text)">{{ ucfirst($user->role) }}</span></td>
                    <td class="px-3 py-3 text-sm border-b border-hairline"><span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background:var(--color-status-{{ $user->status }}-bg);color:var(--color-status-{{ $user->status }}-text)">{{ ucfirst($user->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-10 text-sm">No users yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold mb-4">Recent Job Postings</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Position</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Department</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Deadline</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentJobs as $job)
                <tr class="hover:bg-canvas-soft transition-colors">
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $job->plantillaPosition->position_name ?? '-' }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $job->plantillaPosition->department ?? '-' }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $job->deadline->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted py-10 text-sm">No job postings</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
