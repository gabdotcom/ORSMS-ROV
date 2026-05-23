<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IER - DEPED Region V Recruitment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #0057B8;
            --color-primary-hover: #004494;
            --color-ink: #171717;
            --color-body: #60646c;
            --color-muted: #999999;
            --color-hairline: #f0f0f3;
            --color-hairline-strong: #dcdee0;
            --color-canvas: #fafafa;
            --color-canvas-soft: #f5f5f7;
            --color-surface-card: #ffffff;
            --color-surface-strong: #f0f0f3;
            --color-semantic-success: #16a34a;
            --color-semantic-warning: #ab6400;
            --color-semantic-error: #dc2626;
            --font-sans: 'Inter', -apple-system, system-ui, sans-serif;
            --rounded-md: 8px;
            --rounded-lg: 12px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans);
            background: var(--color-canvas);
            color: var(--color-ink);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: var(--color-surface-card);
            border-right: 1px solid var(--color-hairline);
            padding: 24px 12px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px;
            margin-bottom: 28px;
        }

        .logo svg { width: 32px; height: 32px; }
        .logo-text { font-size: 16px; font-weight: 700; color: var(--color-ink); }
        .logo-text span { color: var(--color-primary); }

        nav { flex: 1; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--rounded-md);
            color: var(--color-body);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            cursor: pointer;
        }

        .nav-link:hover { background: var(--color-surface-strong); color: var(--color-ink); }
        .nav-link.active { background: var(--color-primary); color: white; }

        .nav-section { font-size: 11px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; margin: 20px 12px 8px; }

        .sidebar-footer { margin-top: auto; }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--color-surface-strong);
            border-radius: var(--rounded-md);
        }

        .user-avatar { width: 36px; height: 36px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px; }
        .user-name { font-weight: 500; font-size: 14px; }
        .user-role { font-size: 12px; color: var(--color-body); }

        .logout-btn {
            color: var(--color-body);
            text-decoration: none;
            font-size: 13px;
            display: block;
            margin-top: 16px;
            padding: 8px 12px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }
        .logout-btn:hover { color: #dc2626; }

        .main-content {
            margin-left: 240px;
            flex: 1;
            padding: 32px;
            min-width: 0;
        }

        .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; }
        .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
        .page-subtitle { font-size: 14px; color: var(--color-body); }

        .card {
            background: var(--color-surface-card);
            border: 1px solid var(--color-hairline);
            border-radius: var(--rounded-lg);
            padding: 24px;
            margin-bottom: 24px;
        }

        .form-select {
            padding: 8px 12px;
            border: 1px solid var(--color-hairline-strong);
            border-radius: var(--rounded-md);
            font-size: 14px;
            font-family: inherit;
            background: white;
            min-width: 320px;
        }

        .btn-primary {
            background: var(--color-primary);
            color: white;
            font-size: 14px;
            font-weight: 500;
            padding: 10px 18px;
            border: none;
            border-radius: var(--rounded-md);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 40px;
        }
        .btn-primary:hover { background: var(--color-primary-hover); }
        .btn-secondary {
            background: var(--color-surface-card);
            color: var(--color-ink);
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border: 1px solid var(--color-hairline-strong);
            border-radius: var(--rounded-md);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 36px;
        }
        .btn-secondary:hover { background: var(--color-surface-strong); }
        .btn-sm {
            padding: 4px 10px;
            font-size: 12px;
            height: 30px;
        }

        .table-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .data-table th {
            text-align: center;
            padding: 6px 4px;
            font-size: 9px;
            font-weight: 600;
            color: var(--color-ink);
            border: 1px solid var(--color-hairline-strong);
            background: var(--color-canvas-soft);
            vertical-align: middle;
        }

        .data-table td {
            padding: 6px 4px;
            border: 1px solid var(--color-hairline);
            vertical-align: top;
            font-size: 10px;
        }

        .data-table .col-sensitive { white-space: nowrap; }

        .doc-header {
            margin-bottom: 20px;
        }

        .doc-header .title {
            font-size: 16px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .doc-header .info-line {
            font-size: 13px;
            margin-bottom: 4px;
        }

        .doc-header .info-line .label {
            font-weight: 600;
        }

        .doc-header .quals {
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .doc-header .quals .quals-title {
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .doc-header .quals .qual-item {
            font-size: 12px;
            margin-bottom: 2px;
            padding-left: 16px;
        }

        .doc-header .quals .qual-item .qual-label {
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-qualified { background: #dcfce7; color: #166534; }
        .badge-disqualified { background: #fef2f2; color: #991b1b; }

        .entry-stack > div {
            padding: 2px 0;
            border-bottom: 1px dotted var(--color-hairline);
        }
        .entry-stack > div:last-child {
            border-bottom: none;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-muted);
        }

        .empty-state svg { margin-bottom: 12px; }
        .empty-state p { font-size: 14px; }

        .confirm-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .confirm-overlay.show { display: flex; }
        .confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 400px; text-align: center; }
        .confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
        .confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
        .confirm-buttons { display: flex; gap: 12px; justify-content: center; }
        .confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
        .confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
        .confirm-btn-logout { background: #dc2626; color: white; }

        @media (max-width: 768px) {
            .sidebar { width: 64px; padding: 24px 8px; }
            .sidebar .logo-text, .sidebar .nav-link span, .sidebar .nav-section, .sidebar .user-info, .sidebar .logout-btn { display: none; }
            .main-content { margin-left: 64px; padding: 16px; }
        }

        @media print {
            @page { size: landscape; margin: 8mm; }

            .sidebar, .sidebar-footer, .no-print { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; }
            .card { border: none; box-shadow: none; padding: 0; }
            .table-wrap { overflow: visible; }
            .col-sensitive, .col-exp-date {
                width: 0 !important;
                max-width: 0 !important;
                min-width: 0 !important;
                padding: 0 !important;
                border: none !important;
                font-size: 0 !important;
                line-height: 0 !important;
                overflow: hidden !important;
                visibility: hidden !important;
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
</head>
<body>
    <aside class="sidebar">
        <div class="logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="#0057B8" stroke-width="2">
                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                <path d="M2 17l10 5 10-5"></path>
                <path d="M2 12l10 5 10-5"></path>
            </svg>
            <span class="logo-text">DEPED<span>ROV</span></span>
        </div>
        <nav>
            <a href="{{ route('hr.dashboard') }}" class="nav-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('hr.job-postings') }}" class="nav-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                <span>Job Postings</span>
            </a>
            <a href="{{ route('hr.applications') }}" class="nav-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span>Applications</span>
            </a>
            <div class="nav-section">Reports</div>
            <a href="{{ route('hr.ier') }}" class="nav-link active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span>IER</span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                    <div class="user-role">HR</div>
                </div>
            </div>
            <button class="logout-btn" onclick="showLogoutConfirm()">Sign Out</button>
        </div>
    </aside>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Initial Evaluation Result</h1>
                <p class="page-subtitle">View and print evaluation results per position</p>
            </div>
            <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;" class="no-print">
                <form method="GET" action="{{ route('hr.ier') }}" style="display:flex;gap:8px;align-items:center;">
                    <select name="job_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Select a position...</option>
                        @foreach($jobPostings as $job)
                            <option value="{{ $job->id }}" {{ $selectedJob && $selectedJob->id === $job->id ? 'selected' : '' }}>
                                {{ $job->plantillaPosition->position_name ?? 'Unknown' }} — {{ $job->plantillaPosition->department ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </form>
                @if($selectedJob && $applications->isNotEmpty())
                    <button class="btn-primary" onclick="window.print()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                        Print IER
                    </button>
                @endif
            </div>
        </div>

        @if($selectedJob)
            @php
                $pos = $selectedJob->plantillaPosition;
            @endphp

            <div class="card">
                <div class="doc-header">
                    <div class="title">Initial Evaluation Result (IER)</div>
                    <div class="info-line"><span class="label">Position: </span>{{ $pos->position_name ?? 'N/A' }}</div>
                    <div class="info-line"><span class="label">Salary Grade and Monthly Salary: </span>{{ $pos->salary_grade ?? 'N/A' }}/Php {{ number_format($selectedJob->monthly_salary, 2) }}</div>
                    <div class="quals">
                        <div class="quals-title">Qualification Standards:</div>
                        <div class="qual-item"><span class="qual-label">Education: </span>{{ $selectedJob->required_education ?? 'N/A' }}</div>
                        <div class="qual-item"><span class="qual-label">Training: </span>{{ $selectedJob->required_training ?? 'N/A' }}</div>
                        <div class="qual-item"><span class="qual-label">Experience: </span>{{ $selectedJob->required_experience ?? 'N/A' }}</div>
                        <div class="qual-item"><span class="qual-label">Eligibility: </span>{{ $selectedJob->required_eligibility ?? 'N/A' }}</div>
                    </div>
                </div>

                @if($applications->isEmpty())
                    <div class="empty-state">
                        <p>No evaluated applicants for this position.</p>
                    </div>
                @else
                    <div class="table-wrap">
                        <table class="data-table">
                            <colgroup>
                                <col><!-- No. -->
                                <col><!-- App Code -->
                                <col class="col-sensitive"><!-- Name -->
                                <col class="col-sensitive"><!-- Address -->
                                <col class="col-sensitive"><!-- Age -->
                                <col class="col-sensitive"><!-- Sex -->
                                <col class="col-sensitive"><!-- Civil Status -->
                                <col class="col-sensitive"><!-- Email -->
                                <col class="col-sensitive"><!-- Contact No. -->
                                <col><!-- Education -->
                                <col><!-- Training Title -->
                                <col><!-- Training Hours -->
                                <col><!-- Exp Details -->
                                <col class="col-exp-date"><!-- Exp From -->
                                <col class="col-exp-date"><!-- Exp To -->
                                <col><!-- Exp Yrs/Mos -->
                                <col><!-- Eligibility -->
                                <col><!-- Remarks -->
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

                                        $address = $profile
                                            ? trim(implode(', ', array_filter([
                                                $profile->current_address,
                                                $profile->city,
                                                $profile->province,
                                                $profile->region,
                                            ])))
                                            : '-';

                                        $age = $profile && $profile->date_of_birth
                                            ? $profile->date_of_birth->age
                                            : '-';

                                        $disqualifiedRemarks = [];
                                        if (!$isQualified) {
                                            foreach (['education', 'training', 'experience', 'eligibility'] as $sector) {
                                                $eval = $sectorEvals->get($sector);
                                                if ($eval && $eval->remarks) {
                                                    $disqualifiedRemarks[] = ucfirst($sector) . ': ' . $eval->remarks;
                                                }
                                            }
                                            if ($app->hr_notes) {
                                                $disqualifiedRemarks[] = 'HR Notes: ' . $app->hr_notes;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td style="text-align:center;">{{ $index + 1 }}</td>
                                        <td style="font-family:monospace;font-size:10px;">{{ $app->application_code }}</td>
                                        <td style="white-space:nowrap;" class="col-sensitive">
                                            {{ $app->user->last_name }}, {{ $app->user->first_name }}
                                            {{ $app->user->middle_name ? ' ' . $app->user->middle_name : '' }}
                                        </td>
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
                                                        <div>
                                                            @if($edu->course && $edu->school_name)
                                                                {{ $edu->course }} at {{ $edu->school_name }}
                                                            @elseif($edu->school_name)
                                                                {{ $edu->school_name }}
                                                            @else
                                                                {{ $edu->level ?? '—' }}
                                                            @endif
                                                            @if($edu->year_graduated)
                                                                ({{ $edu->year_graduated }})
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if($app->trainings->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->trainings as $train)
                                                        <div>{{ $train->training_title }}</div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td style="text-align:center;">
                                            @if($app->trainings->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->trainings as $train)
                                                        <div>{{ $train->training_hours ?? '—' }}</div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if($app->experiences->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->experiences as $exp)
                                                        <div>
                                                            {{ $exp->position }} at {{ $exp->employer }}
                                                            @if($exp->sector)
                                                                ({{ $exp->sector }})
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td style="white-space:nowrap;" class="col-exp-date">
                                            @if($app->experiences->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->experiences as $exp)
                                                        <div>{{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('m/d/Y') : '—' }}</div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td style="white-space:nowrap;" class="col-exp-date">
                                            @if($app->experiences->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->experiences as $exp)
                                                        <div>{{ $exp->is_present ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('m/d/Y') : '—') }}</div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td style="white-space:nowrap;">
                                            @if($app->experiences->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->experiences as $exp)
                                                        @php
                                                            $start = $exp->start_date ? \Carbon\Carbon::parse($exp->start_date) : null;
                                                            $end = $exp->is_present ? \Carbon\Carbon::now() : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date) : null);
                                                        @endphp
                                                        <div>
                                                            @if($start && $end)
                                                                @php $diff = $start->diff($end); @endphp
                                                                {{ $diff->y }} Years {{ $diff->m }} Months {{ $diff->d }} Days
                                                            @else
                                                                —
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if($app->eligibilities->isNotEmpty())
                                                <div class="entry-stack">
                                                    @foreach($app->eligibilities as $elig)
                                                        <div>{{ $elig->eligibilityType->name ?? $elig->other_name ?? '—' }}</div>
                                                    @endforeach
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if($isQualified)
                                                <span class="badge badge-qualified">Qualified</span>
                                            @else
                                                <span class="badge badge-disqualified">Disqualified</span>
                                                @if(!empty($disqualifiedRemarks))
                                                    <div style="margin-top:2px;font-size:8px;color:var(--color-body);">
                                                        @foreach($disqualifiedRemarks as $remark)
                                                            <div>{{ $remark }}</div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @else
            <div class="card">
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    <p>Select a position above to view the Initial Evaluation Result.</p>
                </div>
            </div>
        @endif
    </main>

    <div class="confirm-overlay" id="logoutConfirm">
        <div class="confirm-box">
            <h3 class="confirm-title">Sign Out</h3>
            <p class="confirm-message">Are you sure you want to sign out?</p>
            <div class="confirm-buttons">
                <button type="button" class="confirm-btn confirm-btn-cancel" onclick="hideLogoutConfirm()">Cancel</button>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="confirm-btn confirm-btn-logout">Sign Out</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showLogoutConfirm() {
            document.getElementById('logoutConfirm').classList.add('show');
        }
        function hideLogoutConfirm() {
            document.getElementById('logoutConfirm').classList.remove('show');
        }
        document.getElementById('logoutConfirm').addEventListener('click', function(e) {
            if (e.target === this) hideLogoutConfirm();
        });
    </script>
</body>
</html>
