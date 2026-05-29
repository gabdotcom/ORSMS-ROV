@extends('layouts.applicant')
@section('title', 'My Application - DEPED Region V Recruitment')
@push('styles')
<style>
.badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
.locked-notice { background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--rounded-md); padding: 12px; font-size: 13px; color: #92400e; margin-bottom: 16px; }
@media (max-width: 768px) { .grid-cols-2 { grid-template-columns: 1fr; } }
</style>
@endpush
@section('content')
@if(session('success'))<script>showToast('{{ session('success') }}')</script>@endif
@if(session('error'))<script>showToast('{{ session('error') }}',true)</script>@endif

<div class="mb-lg flex items-start justify-between flex-wrap gap-base">
    <div>
        <h1 class="text-2xl font-semibold mb-1">Application: {{ $application->application_code }}</h1>
        <p class="text-sm text-body">{{ $application->job->plantillaPosition->position_name ?? '-' }} - {{ $application->job->plantillaPosition->department ?? '-' }}</p>
    </div>
    <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background: var(--color-status-{{ $application->status }}-bg); color: var(--color-status-{{ $application->status }}-text);">{{ ucfirst($application->status) }}</span>
</div>

@if($application->status !== 'pending')
    <div class="locked-notice">
        <strong>Note:</strong> This application has been {{ $application->status }} and cannot be edited.
    </div>
@endif

<div class="grid grid-cols-2 gap-lg mb-lg max-md:grid-cols-1">
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Application Details</h2>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Application Code</span><span class="text-sm">{{ $application->application_code }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Position</span><span class="text-sm">{{ $application->job->plantillaPosition->position_name ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Department</span><span class="text-sm">{{ $application->job->plantillaPosition->department ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Item No.</span><span class="text-sm">{{ $application->job->plantillaPosition->plantilla_item_no ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Salary Grade</span><span class="text-sm">SG-{{ $application->job->plantillaPosition->salary_grade ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Submitted</span><span class="text-sm">{{ $application->created_at->format('M d, Y h:i A') }}</span></div>
        @if($application->status !== 'pending')
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Reviewed</span><span class="text-sm">{{ $application->reviewed_at ? $application->reviewed_at->format('M d, Y h:i A') : '-' }}</span></div>
        @if($application->hr_notes)
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">HR Notes</span><span class="text-sm">{{ $application->hr_notes }}</span></div>
        @endif
        @endif
    </div>

    @if($application->educations->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Education</h2>
        @foreach($application->educations as $edu)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $edu->level }}</div>
            <div class="text-[13px] text-body">{{ $edu->school_name }}{{ $edu->course ? ' - ' . $edu->course : '' }} ({{ $edu->year_graduated }})</div>
            @if($edu->file_path)
            <a href="{{ asset('storage/' . $edu->file_path) }}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 mt-2 hover:underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                View Document
            </a>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($application->trainings->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Training</h2>
        @foreach($application->trainings as $train)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $train->training_title }}</div>
            <div class="text-[13px] text-body">{{ $train->training_hours ? $train->training_hours . ' hours' : '' }}{{ $train->date_conducted ? ' | ' . \Carbon\Carbon::parse($train->date_conducted)->format('M d, Y') : '' }}</div>
            @if($train->file_path)
            <a href="{{ asset('storage/' . $train->file_path) }}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 mt-2 hover:underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                View Document
            </a>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($application->experiences->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Work Experience</h2>
        @foreach($application->experiences as $exp)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $exp->position }} at {{ $exp->employer }}</div>
            <div class="text-[13px] text-body">{{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }} - {{ $exp->is_present ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '') }}{{ $exp->sector ? ' | ' . $exp->sector : '' }}</div>
            @if($exp->file_path)
            <a href="{{ asset('storage/' . $exp->file_path) }}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 mt-2 hover:underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                View Document
            </a>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($application->eligibilities->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Eligibility</h2>
        @foreach($application->eligibilities as $elig)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $elig->eligibilityType->name ?? 'Other' }}</div>
            <div class="text-[13px] text-body">{{ $elig->license_no ? 'License: ' . $elig->license_no : '' }}{{ $elig->date_issued ? ' | Issued: ' . \Carbon\Carbon::parse($elig->date_issued)->format('M d, Y') : '' }}</div>
            @if($elig->file_path)
            <a href="{{ asset('storage/' . $elig->file_path) }}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 mt-2 hover:underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                View Document
            </a>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($application->documents->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg col-span-2 max-md:col-span-1">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Other Requirements</h2>
        @foreach($application->documents as $doc)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $doc->documentType->name ?? 'Document' }}</div>
            @if($doc->file_path)
            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 hover:underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                View Document
            </a>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>

<div class="flex gap-3">
    <a href="{{ route('applicant.dashboard') }}" class="bg-surface-card text-ink text-sm font-medium px-4 py-2 border border-hairline-strong rounded-md cursor-pointer h-9 inline-flex items-center gap-[6px] hover:bg-surface-strong transition-colors no-underline">Back to Dashboard</a>
    @if($application->status === 'pending')
    <a href="{{ route('applicant.edit-application', $application->id) }}" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 inline-flex items-center gap-2 hover:bg-primary-active transition-colors no-underline">Edit Application</a>
    @endif
</div>
@endsection