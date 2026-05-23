<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>My Application - DEPED Region V Recruitment</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
            body { font-family: var(--font-sans); background: var(--color-canvas); color: var(--color-ink); }
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                width: 240px;
                background: var(--color-surface-card);
                border-right: 1px solid var(--color-hairline);
                padding: 24px 16px;
                display: flex;
                flex-direction: column;
            }
            .main-content { margin-left: 240px; padding: 24px 32px; max-width: 1200px; }
            .logo { display: flex; align-items: center; gap: 10px; margin-bottom: 32px; padding: 0 8px; }
            .logo svg { width: 32px; height: 32px; }
            .logo-text { font-weight: 600; font-size: 16px; }
            .logo-text span { color: var(--color-primary); }
            .nav-link {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 12px;
                color: var(--color-body);
                text-decoration: none;
                border-radius: var(--rounded-md);
                font-size: 14px;
                font-weight: 500;
                margin-bottom: 4px;
            }
            .nav-link:hover { background: var(--color-surface-strong); color: var(--color-ink); }
            .nav-link.active { background: var(--color-primary); color: white; }
            .nav-section { font-size: 11px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; margin: 20px 12px 8px; }
            .sidebar-footer { margin-top: auto; }
            .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-start; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
            .back-link { color: var(--color-primary); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
            .back-link:hover { text-decoration: underline; }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 24px; margin-bottom: 24px; }
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--color-hairline); }
            .info-row { display: flex; padding: 8px 0; border-bottom: 1px solid var(--color-hairline); }
            .info-row:last-child { border-bottom: none; }
            .info-label { width: 150px; color: var(--color-muted); font-size: 13px; }
            .info-value { flex: 1; font-size: 14px; }
            .badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
            .badge-pending { background: #fef3c7; color: #92400e; }
            .badge-qualified { background: #dcfce7; color: #166534; }
            .badge-disqualified { background: #fee2e2; color: #991b1b; }
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
            .btn-danger {
                background: #fee2e2;
                color: #dc2626;
                font-size: 13px;
                font-weight: 500;
                padding: 6px 12px;
                border: none;
                border-radius: var(--rounded-md);
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }
            .btn-danger:hover { background: #fecaca; }
            .btn-sm {
                padding: 4px 10px;
                font-size: 12px;
                height: 30px;
            }
            .entry-item { padding: 12px; background: var(--color-canvas-soft); border-radius: var(--rounded-md); margin-bottom: 12px; }
            .entry-item:last-child { margin-bottom: 0; }
            .entry-title { font-weight: 500; font-size: 14px; margin-bottom: 4px; }
            .entry-detail { font-size: 13px; color: var(--color-body); }
            .entry-file { color: var(--color-primary); text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; }
            .entry-file:hover { text-decoration: underline; }
            .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
            .full-width { grid-column: 1 / -1; }
            .alert { padding: 12px 16px; border-radius: var(--rounded-md); margin-bottom: 20px; font-size: 14px; }
            .alert-success { background: #dcfce7; color: #166534; }
            .alert-error { background: #fee2e2; color: #991b1b; }
            .locked-notice { background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--rounded-md); padding: 12px; font-size: 13px; color: #92400e; margin-bottom: 16px; }
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 36px; height: 36px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px; }
            .user-name { font-weight: 500; font-size: 14px; }
            .user-role { font-size: 12px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; width: 100%; text-align: left; }
            .logout-btn:hover { color: #dc2626; }
            @media (max-width: 768px) {
                .grid { grid-template-columns: 1fr; }
                .sidebar { display: none; }
                .main-content { margin-left: 0; }
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
                <a href="{{ route('applicant.dashboard') }}" class="nav-link {{ Route::is('applicant.dashboard') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('applicant.jobs') }}" class="nav-link {{ Route::is('applicant.jobs') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Job Openings
                </a>
                <a href="{{ route('applicant.profile') }}" class="nav-link {{ Route::is('applicant.profile') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Profile
                </a>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</div>
                    <div>
                        <div class="user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                        <div class="user-role">Applicant</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Sign Out</button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <div class="page-header">
                <div>
                    <h1 class="page-title">Application: {{ $application->application_code }}</h1>
                    <p class="page-subtitle">
                        {{ $application->job->plantillaPosition->position_name ?? '-' }} - 
                        {{ $application->job->plantillaPosition->department ?? '-' }}
                    </p>
                </div>
                <span class="badge badge-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
            </div>

            @if($application->status !== 'pending')
                <div class="locked-notice">
                    <strong>Note:</strong> This application has been {{ $application->status }} and cannot be edited.
                </div>
            @endif

            <div class="grid">
                <!-- Application Info -->
                <div class="card">
                    <h2 class="card-title">Application Details</h2>
                    <div class="info-row">
                        <span class="info-label">Application Code</span>
                        <span class="info-value">{{ $application->application_code }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Position</span>
                        <span class="info-value">{{ $application->job->plantillaPosition->position_name ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Department</span>
                        <span class="info-value">{{ $application->job->plantillaPosition->department ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Item No.</span>
                        <span class="info-value">{{ $application->job->plantillaPosition->plantilla_item_no ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Salary Grade</span>
                        <span class="info-value">SG-{{ $application->job->plantillaPosition->salary_grade ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Submitted</span>
                        <span class="info-value">{{ $application->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    @if($application->status !== 'pending')
                    <div class="info-row">
                        <span class="info-label">Reviewed</span>
                        <span class="info-value">{{ $application->reviewed_at ? $application->reviewed_at->format('M d, Y h:i A') : '-' }}</span>
                    </div>
                    @if($application->hr_notes)
                    <div class="info-row">
                        <span class="info-label">HR Notes</span>
                        <span class="info-value">{{ $application->hr_notes }}</span>
                    </div>
                    @endif
                    @endif
                </div>

                <!-- Education -->
                @if($application->educations->count() > 0)
                <div class="card">
                    <h2 class="card-title">Education</h2>
                    @foreach($application->educations as $edu)
                    <div class="entry-item">
                        <div class="entry-title">{{ $edu->level }}</div>
                        <div class="entry-detail">{{ $edu->school_name }}{{ $edu->course ? ' - ' . $edu->course : '' }} ({{ $edu->year_graduated }})</div>
                        @if($edu->file_path)
                        <a href="{{ asset('storage/' . $edu->file_path) }}" target="_blank" class="entry-file">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            View Document
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Training -->
                @if($application->trainings->count() > 0)
                <div class="card">
                    <h2 class="card-title">Training</h2>
                    @foreach($application->trainings as $train)
                    <div class="entry-item">
                        <div class="entry-title">{{ $train->training_title }}</div>
                        <div class="entry-detail">
                            {{ $train->training_hours ? $train->training_hours . ' hours' : '' }}
                            {{ $train->date_conducted ? ' | ' . \Carbon\Carbon::parse($train->date_conducted)->format('M d, Y') : '' }}
                        </div>
                        @if($train->file_path)
                        <a href="{{ asset('storage/' . $train->file_path) }}" target="_blank" class="entry-file">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            View Document
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Work Experience -->
                @if($application->experiences->count() > 0)
                <div class="card">
                    <h2 class="card-title">Work Experience</h2>
                    @foreach($application->experiences as $exp)
                    <div class="entry-item">
                        <div class="entry-title">{{ $exp->position }} at {{ $exp->employer }}</div>
                        <div class="entry-detail">
                            {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }} - 
                            {{ $exp->is_present ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '') }}
                            {{ $exp->sector ? ' | ' . $exp->sector : '' }}
                        </div>
                        @if($exp->file_path)
                        <a href="{{ asset('storage/' . $exp->file_path) }}" target="_blank" class="entry-file">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            View Document
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Eligibility -->
                @if($application->eligibilities->count() > 0)
                <div class="card">
                    <h2 class="card-title">Eligibility</h2>
                    @foreach($application->eligibilities as $elig)
                    <div class="entry-item">
                        <div class="entry-title">{{ $elig->eligibilityType->name ?? 'Other' }}</div>
                        <div class="entry-detail">
                            {{ $elig->license_no ? 'License: ' . $elig->license_no : '' }}
                            {{ $elig->date_issued ? ' | Issued: ' . \Carbon\Carbon::parse($elig->date_issued)->format('M d, Y') : '' }}
                        </div>
                        @if($elig->file_path)
                        <a href="{{ asset('storage/' . $elig->file_path) }}" target="_blank" class="entry-file">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            View Document
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Documents -->
                @if($application->documents->count() > 0)
                <div class="card full-width">
                    <h2 class="card-title">Other Requirements</h2>
                    @foreach($application->documents as $doc)
                    <div class="entry-item">
                        <div class="entry-title">{{ $doc->documentType->name ?? 'Document' }}</div>
                        @if($doc->file_path)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="entry-file">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            View Document
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div style="margin-top: 24px;">
                <a href="{{ route('applicant.dashboard') }}" class="btn-secondary">Back to Dashboard</a>
                @if($application->status === 'pending')
                <a href="{{ route('applicant.edit-application', $application->id) }}" class="btn-primary" style="margin-left: 12px;">Edit Application</a>
                @endif
            </div>
        </main>
    </body>
</html>