<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>Applications - DEPED Region V Recruitment</title>
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
            .main-content { margin-left: 240px; padding: 24px 32px; }
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
            .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
            .filters { display: flex; gap: 12px; flex-wrap: wrap; }
            .filter-select {
                padding: 8px 12px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                font-size: 14px;
                background: var(--color-surface-card);
                cursor: pointer;
            }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); overflow: hidden; }
            .data-table { width: 100%; border-collapse: collapse; }
            .data-table th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--color-hairline); background: var(--color-canvas-soft); }
            .data-table td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--color-hairline); }
            .data-table tr:last-child td { border-bottom: none; }
            .data-table tr:hover td { background: var(--color-canvas-soft); }
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
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 36px; height: 36px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px; }
            .user-name { font-weight: 500; font-size: 14px; }
            .user-role { font-size: 12px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; width: 100%; text-align: left; }
            .logout-btn:hover { color: #dc2626; }
            .sidebar-footer { margin-top: auto; }
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
                padding: 20px;
            }
            .confirm-overlay.show { display: flex; }
            .confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 500px; width: 100%; }
            .confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
            .confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
            .confirm-buttons { display: flex; gap: 12px; justify-content: flex-end; }
            .confirm-btn { padding: 10px 20px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
            .confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
            .confirm-btn-danger { background: #dc2626; color: white; }
            .action-buttons { display: flex; gap: 8px; }
            .modal-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 2000;
                padding: 20px;
                overflow-y: auto;
            }
            .modal-overlay.show { display: block; }
            .modal-content {
                background: white;
                border-radius: var(--rounded-lg);
                max-width: 900px;
                margin: 20px auto;
                max-height: calc(100vh - 40px);
                overflow-y: auto;
            }
            .modal-header {
                padding: 20px 24px;
                border-bottom: 1px solid var(--color-hairline);
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: sticky;
                top: 0;
                background: white;
                z-index: 1;
            }
            .modal-title { font-size: 20px; font-weight: 600; }
            .modal-close { background: none; border: none; font-size: 28px; cursor: pointer; color: var(--color-body); line-height: 1; }
            .modal-close:hover { color: var(--color-ink); }
            .modal-body { padding: 24px; }
            .modal-footer {
                padding: 16px 24px;
                border-top: 1px solid var(--color-hairline);
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: sticky;
                bottom: 0;
                background: white;
            }
            .section-title { font-size: 16px; font-weight: 600; margin: 24px 0 12px; color: var(--color-primary); }
            .section-title:first-of-type { margin-top: 0; }
            .entry-card {
                border: 1px solid var(--color-hairline);
                border-radius: var(--rounded-md);
                padding: 16px;
                margin-bottom: 12px;
            }
            .entry-card:last-child { margin-bottom: 0; }
            .entry-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; flex-wrap: wrap; gap: 8px; }
            .entry-title { font-weight: 500; font-size: 14px; }
            .entry-detail { font-size: 13px; color: var(--color-body); margin-bottom: 8px; }
            .file-link { color: var(--color-primary); text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; }
            .file-link:hover { text-decoration: underline; }
            .eval-form { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--color-hairline); }
            .eval-radio-group { display: flex; gap: 16px; }
            .eval-radio-label { display: flex; align-items: center; gap: 6px; font-size: 13px; cursor: pointer; }
            .eval-remarks { flex: 1; min-width: 200px; }
            .eval-remarks textarea {
                width: 100%;
                padding: 8px 10px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                font-size: 13px;
                font-family: var(--font-sans);
                resize: vertical;
                min-height: 60px;
            }
            .eval-status { display: inline-block; padding: 2px 8px; font-size: 11px; font-weight: 600; border-radius: 4px; margin-left: 8px; }
            .eval-status.pending { background: #fef3c7; color: #92400e; }
            .eval-status.qualified { background: #dcfce7; color: #166534; }
            .eval-status.disqualified { background: #fee2e2; color: #991b1b; }
            
            /* New Sector Design */
            .sector-section { margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--color-hairline); }
            .sector-section:last-of-type { border-bottom: none; }
            .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
            .section-header .section-title { margin: 0; font-size: 18px; }
            .status-badge { padding: 6px 12px; font-size: 12px; font-weight: 600; border-radius: 6px; }
            .status-badge.qualified { background: #dcfce7; color: #166534; }
            .status-badge.disqualified { background: #fee2e2; color: #991b1b; }
            .status-badge.pending { background: #f3f4f6; color: #6b7280; }
            .entries-card { background: #fafafa; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
            .entry-item { display: flex; gap: 16px; padding: 12px 0; border-bottom: 1px solid #e5e7eb; }
            .entry-item:last-child { border-bottom: none; }
            .entry-number { 
                width: 28px; height: 28px; background: #0057B8; color: white; border-radius: 50%; 
                display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0;
            }
            .entry-details { flex: 1; }
            .detail-row { display: flex; gap: 8px; margin-bottom: 6px; font-size: 13px; }
            .detail-label { color: #6b7280; min-width: 100px; }
            .detail-value { color: #111827; font-weight: 500; }
            .document-link { color: #0057B8; text-decoration: none; font-size: 13px; }
            .document-link:hover { text-decoration: underline; }
            .sector-card { border: 1px solid #e5e7eb; border-radius: 10px; margin-bottom: 20px; overflow: hidden; background: white; }
            .sector-card-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; background: #f8fafc; border-bottom: 1px solid #e5e7eb; }
            .sector-title { margin: 0; font-size: 16px; font-weight: 600; color: #1e293b; }
            .status-badge { padding: 6px 14px; font-size: 12px; font-weight: 600; border-radius: 20px; }
            .status-badge.qualified { background: #dcfce7; color: #166534; }
            .status-badge.disqualified { background: #fee2e2; color: #991b1b; }
            .status-badge.pending { background: #f3f4f6; color: #6b7280; }
            .sector-card-body { padding: 20px; }
            .entry-row { display: flex; gap: 16px; padding: 14px 0; border-bottom: 1px solid #f1f5f9; }
            .entry-row:last-of-type { border-bottom: none; }
            .entry-num { width: 26px; height: 26px; background: #0057B8; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0; }
            .entry-info { flex: 1; }
            .info-line { font-size: 13px; margin-bottom: 4px; }
            .info-label { color: #64748b; }
            .info-value { color: #1e293b; font-weight: 500; }
            .doc-link { color: #0057B8; text-decoration: none; font-size: 13px; }
            .doc-link:hover { text-decoration: underline; }
            .no-data { color: #94a3b8; font-size: 13px; font-style: italic; }
            .eval-section { margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0; }
            .eval-label { font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 12px; }
            .eval-buttons { display: flex; gap: 12px; margin-bottom: 12px; }
            .eval-btn { padding: 10px 20px; border-radius: 6px; border: 1px solid #cbd5e1; background: white; font-size: 13px; font-weight: 500; color: #64748b; cursor: pointer; transition: all 0.2s; }
            .eval-btn:hover { border-color: #0057B8; color: #0057B8; }
            .eval-btn.active { background: #0057B8; color: white; border-color: #0057B8; }
            .eval-text { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; resize: vertical; min-height: 60px; }
            .summary-row { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 16px; }
            .summary-item { flex: 1; min-width: 150px; padding: 12px; background: var(--color-canvas-soft); border-radius: var(--rounded-md); }
            .summary-label { font-size: 12px; color: var(--color-muted); margin-bottom: 4px; }
            .summary-value { font-size: 14px; font-weight: 500; }
            .warning-box { background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--rounded-md); padding: 12px; font-size: 13px; color: #92400e; margin-bottom: 16px; }
            .general-status-form { display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end; }
            .form-group { flex: 1; min-width: 150px; }
            .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; }
            .form-select, .form-textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                font-size: 14px;
                font-family: var(--font-sans);
            }
            .toast {
                position: fixed;
                bottom: 24px;
                right: 24px;
                background: #171717;
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                z-index: 3000;
                display: none;
            }
            .toast.show { display: block; }
            .toast.error { background: #dc2626; }
            .loading { text-align: center; padding: 40px; color: var(--color-body); }
            .no-entries { font-size: 13px; color: var(--color-muted); font-style: italic; }
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
                <a href="{{ route('hr.dashboard') }}" class="nav-link {{ Route::is('hr.dashboard') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('hr.job-postings') }}" class="nav-link {{ Route::is('hr.job-postings') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>Job Postings</span>
                </a>
                <a href="{{ route('hr.applications') }}" class="nav-link {{ Route::is('hr.applications*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    <span>Applications</span>
                </a>
                <div class="nav-section">Reports</div>
                <a href="{{ route('hr.ier') }}" class="nav-link {{ Route::is('hr.ier') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    <span>IER</span>
                </a>
                <div class="nav-section">System</div>
                <a href="#" class="nav-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    <span>Settings</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</div>
                    <div>
                        <div class="user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                        <div class="user-role">HR</div>
                    </div>
                </div>
                <button type="button" class="logout-btn" onclick="showLogoutConfirm()">Sign Out</button>
            </div>
        </aside>
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Applications</h1>
                    <p class="page-subtitle">Manage and review job applications</p>
                </div>
                <div class="filters">
                    <select class="filter-select" id="jobFilter" onchange="filterApplications()">
                        <option value="all">All Jobs</option>
                        @foreach($jobPostings as $job)
                            <option value="{{ $job->id }}">{{ $job->plantillaPosition->position_name ?? 'Position' }} ({{ $job->plantillaPosition->department ?? 'Department' }})</option>
                        @endforeach
                    </select>
                    <select class="filter-select" id="statusFilter" onchange="filterApplications()">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="qualified">Qualified</option>
                        <option value="disqualified">Disqualified</option>
                    </select>
                </div>
            </div>

            <div class="toast" id="toast"></div>

            @if(session('success'))
            <script>showToast('{{ session('success') }}');</script>
            @endif

            <div class="card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Application Code</th>
                            <th>Applicant</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="applicationsTable">
                        @forelse($applications as $app)
                            <tr data-job-id="{{ $app->job_id }}" data-status="{{ $app->status }}">
                                <td style="font-weight: 500;">{{ $app->application_code }}</td>
                                <td>{{ $app->user->first_name ?? '-' }} {{ $app->user->last_name ?? '' }}</td>
                                <td>{{ $app->job->plantillaPosition->position_name ?? '-' }}</td>
                                <td>{{ $app->job->plantillaPosition->department ?? '-' }}</td>
                                <td><span class="badge badge-{{ $app->status }}">{{ ucfirst($app->status) }}</span></td>
                                <td>{{ $app->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-secondary" onclick="openReviewModal({{ $app->id }})">Review</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--color-muted); padding: 40px;">No applications found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Logout Confirmation -->
        <div class="confirm-overlay" id="logoutConfirm">
            <div class="confirm-box">
                <h3 class="confirm-title">Sign Out</h3>
                <p class="confirm-message">Are you sure you want to sign out?</p>
                <div class="confirm-buttons">
                    <button type="button" class="confirm-btn confirm-btn-cancel" onclick="hideLogoutConfirm()">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="confirm-btn confirm-btn-danger">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Review Modal -->
        <div class="modal-overlay" id="reviewModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="reviewModalTitle">Application Review</h2>
                    <button class="modal-close" onclick="closeReviewModal()">&times;</button>
                </div>
                <div class="modal-body" id="reviewModalBody">
                    <div class="loading">Loading application details...</div>
                </div>
                <div class="modal-footer">
                    <div id="generalStatusSection">
                        <div class="warning-box" id="statusWarning" style="display: none;"></div>
                        <form id="generalStatusForm" method="POST" action="" style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="form-label">General Status</label>
                                <select name="status" class="form-select" id="generalStatusSelect" style="min-width: 150px;">
                                    <option value="pending">Pending</option>
                                    <option value="qualified">Qualified</option>
                                    <option value="disqualified">Disqualified</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 0; flex: 1;">
                                <label class="form-label">Notes</label>
                                <textarea name="hr_notes" class="form-textarea" id="generalStatusNotes" placeholder="Add notes..." style="min-width: 200px;"></textarea>
                            </div>
                            <button type="submit" class="btn-primary" id="updateStatusBtn">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="toast" id="toast">Evaluation saved!</div>

        <script>
            function filterApplications() {
                const jobFilter = document.getElementById('jobFilter').value;
                const statusFilter = document.getElementById('statusFilter').value;
                
                document.querySelectorAll('#applicationsTable tr').forEach(row => {
                    const jobId = row.dataset.jobId;
                    const status = row.dataset.status;
                    
                    const matchJob = jobFilter === 'all' || jobId === jobFilter;
                    const matchStatus = statusFilter === 'all' || status === statusFilter;
                    
                    row.style.display = (matchJob && matchStatus) ? 'table-row' : 'none';
                });
            }

            function showLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.add('show');
            }
            function hideLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.remove('show');
            }
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideLogoutConfirm();
                    closeReviewModal();
                }
            });
            document.getElementById('logoutConfirm').addEventListener('click', function(e) {
                if (e.target === this) hideLogoutConfirm();
            });
            document.getElementById('reviewModal').addEventListener('click', function(e) {
                if (e.target === this) closeReviewModal();
            });

            let currentAppId = null;
            let sectorEvaluations = {};

            async function openReviewModal(appId) {
                currentAppId = appId;
                document.getElementById('reviewModal').classList.add('show');
                document.getElementById('reviewModalBody').innerHTML = '<div class="loading">Loading application details...</div>';
                
                try {
                    const response = await fetch(`/hr/applications/${appId}/details`);
                    const data = await response.json();
                    
                    sectorEvaluations = {};
                    if (data.sectorEvaluations) {
                        Object.keys(data.sectorEvaluations).forEach(key => {
                            sectorEvaluations[key] = data.sectorEvaluations[key];
                        });
                    }
                    
                    renderApplicationDetails(data.application);
                } catch (error) {
                    console.error('Error loading application:', error);
                    document.getElementById('reviewModalBody').innerHTML = '<div class="loading">Error loading application details.</div>';
                }
            }

            function closeReviewModal() {
                document.getElementById('reviewModal').classList.remove('show');
                currentAppId = null;
            }

            function renderApplicationDetails(app) {
                const body = document.getElementById('reviewModalBody');
                const createdAt = new Date(app.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                
                let html = `
                    <div class="summary-row">
                        <div class="summary-item">
                            <div class="summary-label">Application Code</div>
                            <div class="summary-value">${app.application_code}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Applicant</div>
                            <div class="summary-value">${app.user?.first_name || ''} ${app.user?.last_name || ''}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Position</div>
                            <div class="summary-value">${app.job?.plantilla_position?.position_name || '-'}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Department</div>
                            <div class="summary-value">${app.job?.plantilla_position?.department || '-'}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Submitted</div>
                            <div class="summary-value">${createdAt}</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Current Status</div>
                            <div class="summary-value"><span class="badge badge-${app.status}">${app.status}</span></div>
                        </div>
                    </div>
                `;

                // Education Section with sector evaluation
                html += renderSectorSection('education', app.educations, [
                    { title: 'Level', key: 'level' },
                    { title: 'School', key: 'school_name' },
                    { title: 'Course', key: 'course' },
                    { title: 'Year', key: 'year_graduated' }
                ]);

                // Training Section
                html += renderSectorSection('training', app.trainings, [
                    { title: 'Title', key: 'training_title' },
                    { title: 'Hours', key: 'training_hours' },
                    { title: 'Date', key: 'date_conducted' }
                ]);

                // Experience Section
                html += renderSectorSection('experience', app.experiences, [
                    { title: 'Position', key: 'position' },
                    { title: 'Employer', key: 'employer' },
                    { title: 'Period', key: 'period' },
                    { title: 'Sector', key: 'sector' }
                ]);

                // Eligibility Section
                html += renderSectorSection('eligibility', app.eligibilities, [
                    { title: 'Type', key: 'type' },
                    { title: 'License No', key: 'license_no' },
                    { title: 'Date Issued', key: 'date_issued' }
                ]);

                // Other Requirements
                html += `<div class="section-title">Other Requirements</div>`;
                if (app.documents && app.documents.length > 0) {
                    app.documents.forEach(doc => {
                        const fileUrl = doc.file_path ? `/storage/${doc.file_path}` : null;
                        html += `
                            <div class="entry-card">
                                <div class="entry-header">
                                    <div>
                                        <div class="entry-title">${doc.document_type?.name || 'Document'}</div>
                                        ${fileUrl ? `<a href="${fileUrl}" target="_blank" class="file-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    html += '<p class="no-entries">No documents uploaded</p>';
                }

                // Update general status form
                const statusForm = document.getElementById('generalStatusForm');
                statusForm.action = `/hr/applications/${app.id}/status`;
                document.getElementById('generalStatusNotes').value = app.hr_notes || '';
                
                // Check if all sectors are evaluated
                const allEvaluated = ['education', 'training', 'experience', 'eligibility'].every(s => 
                    sectorEvaluations[s] && (sectorEvaluations[s].status === 'qualified' || sectorEvaluations[s].status === 'disqualified')
                );
                
                // Only allow qualified if all sectors are qualified
                const statusSelect = document.getElementById('generalStatusSelect');
                statusSelect.innerHTML = `
                    <option value="pending" ${app.status === 'pending' ? 'selected' : ''}>Pending</option>
                    <option value="qualified" ${app.status === 'qualified' ? 'selected' : ''} ${!allEvaluated ? 'disabled' : ''}>Qualified</option>
                    <option value="disqualified" ${app.status === 'disqualified' ? 'selected' : ''}>Disqualified</option>
                `;

                body.innerHTML = html;
            }

            function formatDate(dateStr) {
                if (!dateStr) return '-';
                const d = new Date(dateStr);
                return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            }

            function renderSectorSection(sectorName, entries, fields) {
                const sectorTitle = sectorName.charAt(0).toUpperCase() + sectorName.slice(1);
                const eval = sectorEvaluations[sectorName];
                const status = eval?.status || '';
                const isQualified = status === 'qualified';
                const isDisqualified = status === 'disqualified';
                
                let statusBadge = '';
                if (isQualified) {
                    statusBadge = `<span class="status-badge qualified">Qualified</span>`;
                } else if (isDisqualified) {
                    statusBadge = `<span class="status-badge disqualified">Disqualified</span>`;
                } else {
                    statusBadge = `<span class="status-badge pending">Not Evaluated</span>`;
                }
                
                // Single card containing entries and evaluation
                let html = `<div class="sector-card">
                    <div class="sector-card-header">
                        <h3 class="sector-title">${sectorTitle}</h3>
                        ${statusBadge}
                    </div>
                    <div class="sector-card-body">`;
                
                // Entries
                if (entries && entries.length > 0) {
                    entries.forEach((entry, index) => {
                        html += `<div class="entry-row">
                            <div class="entry-num">${index + 1}</div>
                            <div class="entry-info">`;
                        
                        fields.forEach(field => {
                            let label = '';
                            let value = '';
                            
                            if (field.key === 'period') {
                                label = 'Period';
                                value = formatDate(entry.start_date) + (entry.is_present ? ' - Present' : (entry.end_date ? ' - ' + formatDate(entry.end_date) : ''));
                            } else if (field.key === 'type') {
                                label = 'Type';
                                value = entry.eligibility_type?.name || entry.other_name || '-';
                            } else if (field.key === 'year_graduated') {
                                label = 'Year Graduated';
                                value = entry[field.key] || '-';
                            } else if (field.key === 'training_hours') {
                                label = 'Hours';
                                value = entry[field.key] ? entry[field.key] + ' hours' : '-';
                            } else if (['date_conducted', 'date_issued'].includes(field.key)) {
                                label = field.title;
                                value = formatDate(entry[field.key]);
                            } else {
                                label = field.title;
                                value = entry[field.key] || '-';
                            }
                            
                            html += `<div class="info-line"><span class="info-label">${label}:</span> <span class="info-value">${value}</span></div>`;
                        });
                        
                        const fileUrl = entry.file_path ? `/storage/${entry.file_path}` : null;
                        if (fileUrl) {
                            html += `<div class="info-line"><span class="info-label">Document:</span> <a href="${fileUrl}" target="_blank" class="doc-link">View</a></div>`;
                        }
                        
                        html += `</div></div>`;
                    });
                } else {
                    html += `<p class="no-data">No records found</p>`;
                }
                
                // Evaluation inside same card
                html += `<div class="eval-section">
                    <div class="eval-label">Evaluation</div>
                    <div class="eval-buttons">
                        <button type="button" class="eval-btn ${status === 'qualified' ? 'active' : ''}" onclick="saveSectorEvaluation('${sectorName}', 'qualified')">Qualified</button>
                        <button type="button" class="eval-btn ${status === 'disqualified' ? 'active' : ''}" onclick="saveSectorEvaluation('${sectorName}', 'disqualified')">Disqualified</button>
                    </div>
                    <textarea class="eval-text" placeholder="Add remarks..." id="remarks_${sectorName}">${eval?.remarks || ''}</textarea>
                </div>`;
                
                html += `</div></div>`;

                return html;
            }

            function renderEvaluationForm(sectorName) {
                const eval = sectorEvaluations[sectorName];
                const status = eval?.status || '';
                const remarks = eval?.remarks || '';
                
                return `
                    <div class="evaluation-card">
                        <div class="eval-title">Evaluation</div>
                        <div class="eval-options">
                            <label class="eval-option ${status === 'qualified' ? 'active' : ''}">
                                <input type="radio" name="sector_${sectorName}" value="qualified" ${status === 'qualified' ? 'checked' : ''} onchange="saveSectorEvaluation('${sectorName}', 'qualified')">
                                <span class="option-label">Qualified</span>
                            </label>
                            <label class="eval-option ${status === 'disqualified' ? 'active' : ''}">
                                <input type="radio" name="sector_${sectorName}" value="disqualified" ${status === 'disqualified' ? 'checked' : ''} onchange="saveSectorEvaluation('${sectorName}', 'disqualified')">
                                <span class="option-label">Disqualified</span>
                            </label>
                        </div>
                        <div class="eval-remarks">
                            <textarea placeholder="Add remarks..." onchange="saveSectorEvaluation('${sectorName}', '${status}', this.value)">${remarks}</textarea>
                        </div>
                    </div>
                `;
            }

            async function saveSectorEvaluation(sector, status, remarks = '') {
                try {
                    const form = document.getElementById('generalStatusForm');
                    const formData = new FormData(form);
                    formData.append(`sectors[${sector}][status]`, status);
                    
                    // Get remarks from textarea
                    const remarksEl = document.getElementById('remarks_' + sector);
                    if (remarksEl && remarksEl.value) {
                        formData.append(`sectors[${sector}][remarks]`, remarksEl.value);
                    }
                    
                    const response = await fetch(`/hr/applications/${currentAppId}/sector-evaluation`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        sectorEvaluations[sector] = { status: status, remarks: remarks || '' };
                        
                        const sectorTitle = sector.charAt(0).toUpperCase() + sector.slice(1);
                        const modalBody = document.getElementById('reviewModalBody');
                        
                        // Update badge
                        const sectorIndex = ['education','training','experience','eligibility'].indexOf(sector) + 1;
                        const cardEl = modalBody.querySelectorAll('.sector-card')[sectorIndex - 1];
                        if (cardEl) {
                            const badgeEl = cardEl.querySelector('.status-badge');
                            if (badgeEl) {
                                badgeEl.className = 'status-badge ' + status;
                                badgeEl.textContent = status === 'qualified' ? 'Qualified' : 'Disqualified';
                            }
                            // Update buttons
                            const buttons = cardEl.querySelectorAll('.eval-btn');
                            buttons.forEach(btn => {
                                btn.classList.remove('active');
                                if (btn.textContent.toLowerCase() === status) {
                                    btn.classList.add('active');
                                }
                            });
                        }
                        
                        // Update general status dropdown
                        updateGeneralStatus();
                        
                        showToast(`${sectorTitle} evaluation saved!`);
                    } else {
                        showToast('Error saving evaluation', true);
                    }
                } catch (error) {
                    console.error('Error saving evaluation:', error);
                    showToast('Error saving evaluation', true);
                }
            }

            function updateGeneralStatus() {
                const sectors = ['education', 'training', 'experience', 'eligibility'];
                let allQualified = true;
                let anyDisqualified = false;
                let allEvaluated = true;
                
                sectors.forEach(s => {
                    const eval = sectorEvaluations[s];
                    if (!eval || (eval.status !== 'qualified' && eval.status !== 'disqualified')) {
                        allEvaluated = false;
                    }
                    if (eval && eval.status === 'disqualified') {
                        anyDisqualified = true;
                        allQualified = false;
                    } else if (eval && eval.status === 'qualified') {
                        // still qualified
                    } else {
                        allQualified = false;
                    }
                });
                
                const statusSelect = document.getElementById('generalStatusSelect');
                const currentValue = statusSelect.value;
                
                // If any sector is disqualified - disable qualified option
                if (anyDisqualified) {
                    statusSelect.innerHTML = `
                        <option value="pending" ${currentValue === 'pending' ? 'selected' : ''}>Pending</option>
                        <option value="qualified" disabled ${currentValue === 'qualified' ? 'selected' : ''}>Qualified</option>
                        <option value="disqualified" ${currentValue === 'disqualified' ? 'selected' : ''}>Disqualified</option>
                    `;
                } else if (!allEvaluated) {
                    statusSelect.innerHTML = `
                        <option value="pending" ${currentValue === 'pending' ? 'selected' : ''}>Pending</option>
                        <option value="qualified" disabled ${currentValue === 'qualified' ? 'selected' : ''}>Qualified</option>
                        <option value="disqualified" ${currentValue === 'disqualified' ? 'selected' : ''}>Disqualified</option>
                    `;
                } else if (allQualified && allEvaluated) {
                    // All qualified - enable qualified option but don't auto-select
                    statusSelect.innerHTML = `
                        <option value="pending" ${currentValue === 'pending' ? 'selected' : ''}>Pending</option>
                        <option value="qualified" ${currentValue === 'qualified' ? 'selected' : ''}>Qualified</option>
                        <option value="disqualified" ${currentValue === 'disqualified' ? 'selected' : ''}>Disqualified</option>
                    `;
                }
            }

            function showToast(message, isError = false) {
                const toast = document.getElementById('toast');
                toast.textContent = message;
                toast.className = 'toast' + (isError ? ' error' : '');
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3000);
            }
        </script>
    </body>
</html>