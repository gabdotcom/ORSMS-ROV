@extends('layouts.hr')
@section('title', 'HR Dashboard - DEPED Region V Recruitment')
@section('content')
<div class="mb-lg">
    <h1 class="text-2xl font-semibold mb-1">HR Dashboard</h1>
    <p class="text-sm text-body">Overview of recruitment activities</p>
</div>

<div class="grid grid-cols-4 max-lg:grid-cols-2 gap-5 mb-xl">
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-xs text-muted mb-1">Open Positions</div>
        <div class="text-[28px] font-semibold">{{ $openPositions }}</div>
        <div class="text-xs text-semantic-success">{{ $thisMonthApplications }} this month</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-xs text-muted mb-1">Total Applications</div>
        <div class="text-[28px] font-semibold">{{ $totalApplications }}</div>
        <div class="text-xs text-body">All time</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-xs text-muted mb-1">Pending Review</div>
        <div class="text-[28px] font-semibold">{{ $pendingApplications }}</div>
        <div class="text-xs text-accent-warning">{{ $pendingApplications > 0 ? 'Needs attention' : 'All caught up' }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-xs text-muted mb-1">Qualified</div>
        <div class="text-[28px] font-semibold">{{ $qualifiedApplications }}</div>
        <div class="text-xs text-semantic-success">{{ $qualifiedApplications > 0 ? 'Passed evaluation' : 'No qualified yet' }}</div>
    </div>
</div>

<div class="grid grid-cols-2 max-lg:grid-cols-1 gap-lg">
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <div class="flex items-center justify-between mb-base">
            <h2 class="text-base font-semibold">Recent Job Postings</h2>
            <a href="{{ route('hr.job-postings') }}" class="text-sm text-primary no-underline hover:underline">View All</a>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Position</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Department</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Status</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Applicants</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentJobs as $job)
                <tr class="hover:bg-canvas-soft transition-colors">
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $job->plantillaPosition->position_name ?? '-' }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $job->plantillaPosition->department ?? '-' }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline"><span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px] bg-status-{{ $job->status }}-bg text-status-{{ $job->status }}-text">{{ ucfirst($job->status) }}</span></td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $job->applications_count ?? $job->applications->count() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-8 text-sm">No job postings yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <div class="flex items-center justify-between mb-base">
            <h2 class="text-base font-semibold">Recent Applications</h2>
            <a href="{{ route('hr.applications') }}" class="text-sm text-primary no-underline hover:underline">View All</a>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Applicant</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Position</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Status</th>
                    <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Submitted</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentApplications as $app)
                <tr class="hover:bg-canvas-soft transition-colors">
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $app->user->first_name ?? '-' }} {{ $app->user->last_name ?? '' }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $app->job->plantillaPosition->position_name ?? '-' }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">
                        @php
                            $badgeClass = $app->status === 'pending' ? 'status-pending' : ($app->status === 'qualified' ? 'status-reviewed' : 'status-closed');
                        @endphp
                        <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px] bg-{{ $badgeClass }}-bg text-{{ $badgeClass }}-text">{{ ucfirst($app->status) }}</span>
                    </td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $app->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-8 text-sm">No applications yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
