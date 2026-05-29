@extends('layouts.hr')
@section('title', 'IER - DEPED Region V Recruitment')
@push('styles')
<style>
.form-select { padding: 8px 12px; border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); font-size: 14px; font-family: inherit; background: white; min-width: 320px; }
.table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.data-table { width: 100%; border-collapse: collapse; font-size: 11px; }
.data-table th { text-align: center; padding: 6px 4px; font-size: 9px; font-weight: 600; color: var(--color-ink); border: 1px solid var(--color-hairline-strong); background: var(--color-canvas-soft); vertical-align: middle; }
.data-table td { padding: 6px 4px; border: 1px solid var(--color-hairline); vertical-align: top; font-size: 10px; }
.data-table .col-sensitive { white-space: nowrap; }
.doc-header { margin-bottom: 20px; }
.entry-stack > div { padding: 2px 0; border-bottom: 1px dotted var(--color-hairline); }
.entry-stack > div:last-child { border-bottom: none; }
.empty-state { text-align: center; padding: 60px 20px; color: var(--color-muted); }
.empty-state svg { margin-bottom: 12px; }
.empty-state p { font-size: 14px; }
.badge { display: inline-block; padding: 2px 6px; font-size: 9px; font-weight: 600; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px; }
.badge-qualified { background: #dcfce7; color: #166534; }
.badge-disqualified { background: #fef2f2; color: #991b1b; }
@media print {
    @page { size: landscape; margin: 8mm; }
    aside, .no-print, #logoutConfirm { display: none !important; }
    main { margin-left: 0 !important; padding: 0 !important; }
    .table-wrap { overflow: visible; }
    .col-sensitive, .col-exp-date {
        width: 0 !important; max-width: 0 !important; min-width: 0 !important;
        padding: 0 !important; border: none !important;
        font-size: 0 !important; line-height: 0 !important;
        overflow: hidden !important; visibility: hidden !important;
    }
    .data-table th, .data-table td { padding: 4px 4px; font-size: 9px; }
    .data-table th { font-size: 8px; }
    .data-table { page-break-inside: auto; }
    .data-table tr { page-break-inside: avoid; }
    body { background: white; }
    .page-header { margin-bottom: 8px; }
    .page-title { font-size: 16px; }
    .page-subtitle { font-size: 11px; }
    .doc-header .title { font-size: 14px; margin-bottom: 10px; }
    .doc-header .info-line { font-size: 11px; margin-bottom: 2px; }
    .doc-header .quals .qual-item { font-size: 10px; }
    .badge { font-size: 8px; padding: 1px 6px; }
    .page-header > div:first-child { display: none !important; }
    .page-header > div:last-child { display: none !important; }
}
</style>
@endpush
@section('content')
<div class="page-header mb-lg flex items-start justify-between flex-wrap gap-base no-print">
    <div>
        <h1 class="text-2xl font-semibold mb-1">Initial Evaluation Result</h1>
        <p class="text-sm text-body">View and print evaluation results per position</p>
    </div>
    <div class="flex gap-2 items-center flex-wrap">
        <form method="GET" action="{{ route('hr.ier') }}" class="flex gap-2 items-center">
            <select name="job_id" class="form-select" onchange="this.form.submit()">
                <option value="">Select a position...</option>
                @foreach($jobPostings as $job)
                    <option value="{{ $job->id }}" {{ $selectedJob && $selectedJob->id === $job->id ? 'selected' : '' }}>
                        {{ $job->plantillaPosition->position_name ?? 'Unknown' }} &mdash; {{ $job->plantillaPosition->department ?? '' }}
                    </option>
                @endforeach
            </select>
        </form>
        @if($selectedJob && $applications->isNotEmpty())
            <button class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors inline-flex items-center gap-2 no-print" onclick="window.print()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                Print IER
            </button>
        @endif
    </div>
</div>

@if($selectedJob)
    @php $pos = $selectedJob->plantillaPosition; @endphp

    <div class="doc-header">
            <div class="text-base font-bold text-center mb-4 uppercase">Initial Evaluation Result (IER)</div>
            <div class="text-[13px] mb-1"><span class="font-semibold">Position: </span>{{ $pos->position_name ?? 'N/A' }}</div>
            <div class="text-[13px] mb-1"><span class="font-semibold">Salary Grade and Monthly Salary: </span>{{ $pos->salary_grade ?? 'N/A' }}/Php {{ number_format($selectedJob->monthly_salary, 2) }}</div>
            <div class="mt-2 mb-4">
                <div class="font-semibold text-[13px] mb-1">Qualification Standards:</div>
                <div class="text-xs mb-[2px] pl-4"><span class="font-semibold">Education: </span>{{ $selectedJob->required_education ?? 'N/A' }}</div>
                <div class="text-xs mb-[2px] pl-4"><span class="font-semibold">Training: </span>{{ $selectedJob->required_training ?? 'N/A' }}</div>
                <div class="text-xs mb-[2px] pl-4"><span class="font-semibold">Experience: </span>{{ $selectedJob->required_experience ?? 'N/A' }}</div>
                <div class="text-xs mb-[2px] pl-4"><span class="font-semibold">Eligibility: </span>{{ $selectedJob->required_eligibility ?? 'N/A' }}</div>
            </div>
        </div>

        @if($applications->isEmpty())
            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <p>No evaluated applicants for this position.</p>
            </div>
        @else
            <div class="table-wrap">
                <table class="data-table">
                    <colgroup>
                        <col><col><col class="col-sensitive"><col class="col-sensitive"><col class="col-sensitive"><col class="col-sensitive"><col class="col-sensitive"><col class="col-sensitive"><col class="col-sensitive">
                        <col><col><col><col><col class="col-exp-date"><col class="col-exp-date"><col><col><col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:24px;">No.</th>
                            <th rowspan="2" style="width:80px;">Application Code</th>
                            <th rowspan="2" style="min-width:120px;" class="col-sensitive">Names of Applicant</th>
                            <th colspan="6" class="col-sensitive">Personal Information</th>
                            <th rowspan="2" style="min-width:100px;">Education</th>
                            <th colspan="2">Training</th>
                            <th colspan="4">Experience</th>
                            <th rowspan="2" style="min-width:80px;">Eligibility</th>
                            <th rowspan="2" style="min-width:60px;">Remarks</th>
                        </tr>
                        <tr>
                            <th class="col-sensitive">Address</th>
                            <th class="col-sensitive">Age</th>
                            <th class="col-sensitive">Sex</th>
                            <th class="col-sensitive">Civil Status</th>
                            <th class="col-sensitive">Email Address</th>
                            <th class="col-sensitive">Contact No.</th>
                            <th>Title</th>
                            <th>Hours</th>
                            <th>Details</th>
                            <th class="col-exp-date">From</th>
                            <th class="col-exp-date">To</th>
                            <th>Years/Months</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $index => $app)
                            @php
                                $profile = $app->user->applicantProfile;
                                $sectorEvals = $app->sectorEvaluations->keyBy('sector');
                                $isQualified = $app->status === 'qualified';
                                $address = $profile ? trim(implode(', ', array_filter([$profile->current_address, $profile->city, $profile->province, $profile->region]))) : '-';
                                $age = $profile && $profile->date_of_birth ? $profile->date_of_birth->age : '-';
                                $disqualifiedRemarks = [];
                                if (!$isQualified) {
                                    foreach (['education', 'training', 'experience', 'eligibility'] as $sector) {
                                        $eval = $sectorEvals->get($sector);
                                        if ($eval && $eval->remarks) $disqualifiedRemarks[] = ucfirst($sector) . ': ' . $eval->remarks;
                                    }
                                    if ($app->hr_notes) $disqualifiedRemarks[] = 'HR Notes: ' . $app->hr_notes;
                                }
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ $index + 1 }}</td>
                                <td style="font-family:monospace;font-size:10px;">{{ $app->application_code }}</td>
                                <td style="white-space:nowrap;" class="col-sensitive">{{ $app->user->last_name }}, {{ $app->user->first_name }} {{ $app->user->middle_name ? ' ' . $app->user->middle_name : '' }}</td>
                                <td class="col-sensitive" style="max-width:120px;font-size:10px;">{{ $address }}</td>
                                <td class="col-sensitive" style="text-align:center;">{{ $age }}</td>
                                <td class="col-sensitive">{{ $profile ? ucfirst($profile->gender) : '-' }}</td>
                                <td class="col-sensitive">{{ $profile ? $profile->civil_status : '-' }}</td>
                                <td class="col-sensitive" style="font-size:10px;">{{ $app->user->email }}</td>
                                <td class="col-sensitive">{{ $profile->contact_number ?? '-' }}</td>
                                <td>
                                    @if($app->educations->isNotEmpty())
                                        <div class="entry-stack">
                                            @foreach($app->educations as $edu)
                                                <div>@if($edu->course && $edu->school_name){{ $edu->course }} at {{ $edu->school_name }}@elseif($edu->school_name){{ $edu->school_name }}@else{{ $edu->level ?? '&mdash;' }}@endif @if($edu->year_graduated)({{ $edu->year_graduated }})@endif</div>
                                            @endforeach
                                        </div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td>
                                    @if($app->trainings->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->trainings as $train)<div>{{ $train->training_title }}</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    @if($app->trainings->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->trainings as $train)<div>{{ $train->training_hours ?? '&mdash;' }}</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td>
                                    @if($app->experiences->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->experiences as $exp)<div>{{ $exp->position }} at {{ $exp->employer }}@if($exp->sector) ({{ $exp->sector }})@endif</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td style="white-space:nowrap;" class="col-exp-date">
                                    @if($app->experiences->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->experiences as $exp)<div>{{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('m/d/Y') : '&mdash;' }}</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td style="white-space:nowrap;" class="col-exp-date">
                                    @if($app->experiences->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->experiences as $exp)<div>{{ $exp->is_present ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('m/d/Y') : '&mdash;') }}</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td style="white-space:nowrap;">
                                    @if($app->experiences->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->experiences as $exp)@php $start = $exp->start_date ? \Carbon\Carbon::parse($exp->start_date) : null; $end = $exp->is_present ? \Carbon\Carbon::now() : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date) : null); $dur = ($start && $end) ? $start->diff($end) : null; @endphp<div>{{ $dur ? $dur->y . ' Years ' . $dur->m . ' Months ' . $dur->d . ' Days' : '&mdash;' }}</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td>
                                    @if($app->eligibilities->isNotEmpty())
                                        <div class="entry-stack">@foreach($app->eligibilities as $elig)<div>{{ $elig->eligibilityType->name ?? $elig->other_name ?? '&mdash;' }}</div>@endforeach</div>
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td>
                                    @if($isQualified)
                                        <span class="badge badge-qualified">Qualified</span>
                                    @else
                                        <span class="badge badge-disqualified">Disqualified</span>
                                        @if(!empty($disqualifiedRemarks))
                                            <div style="margin-top:2px;font-size:8px;color:var(--color-body);">@foreach($disqualifiedRemarks as $remark)<div>{{ $remark }}</div>@endforeach</div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
@else
    <div class="empty-state">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            <p>Select a position above to view the Initial Evaluation Result.</p>
        </div>
@endif
@endsection
