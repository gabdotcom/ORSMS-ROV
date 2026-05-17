<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>Dashboard - DEPED Region V Recruitment</title>
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
            .page-header { margin-bottom: 24px; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
            .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
            .stat-card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 20px; }
            .stat-label { font-size: 13px; color: var(--color-muted); margin-bottom: 4px; }
            .stat-value { font-size: 28px; font-weight: 600; }
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
                padding: 8px 16px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
            }
            .btn-primary:hover { background: var(--color-primary-hover); }
            .btn-danger {
                background: #fee2e2;
                color: #dc2626;
                font-size: 13px;
                font-weight: 500;
                padding: 6px 12px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
            }
            .btn-danger:hover { background: #fecaca; }
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 40px; height: 40px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; }
            .user-name { font-weight: 500; }
            .user-role { font-size: 13px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; }
            .logout-btn:hover { color: #dc2626; }
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
            .confirm-btn-cancel:hover { background: var(--color-hairline); }
            .confirm-btn-danger { background: #dc2626; color: white; }
            .confirm-btn-danger:hover { background: #b91c1c; }
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
            .section-title { font-size: 16px; font-weight: 600; margin: 20px 0 12px; color: var(--color-primary); }
            .section-title:first-of-type { margin-top: 0; }
            .entry-item { padding: 12px; background: var(--color-canvas-soft); border-radius: var(--rounded-md); margin-bottom: 12px; }
            .entry-item:last-child { margin-bottom: 0; }
            .entry-title { font-weight: 500; font-size: 14px; margin-bottom: 4px; }
            .entry-detail { font-size: 13px; color: var(--color-body); }
            .entry-file { color: var(--color-primary); text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; }
            .entry-file:hover { text-decoration: underline; }
            .info-row { display: flex; padding: 8px 0; border-bottom: 1px solid var(--color-hairline); }
            .info-row:last-child { border-bottom: none; }
            .info-label { width: 150px; color: var(--color-muted); font-size: 13px; }
            .info-value { flex: 1; font-size: 14px; }
            .form-group { margin-bottom: 16px; }
            .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; }
            .form-input, .form-select {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                font-size: 14px;
                font-family: var(--font-sans);
            }
            .form-input:focus, .form-select:focus { outline: none; border-color: var(--color-primary); }
            .entry-row {
                border: 1px solid var(--color-hairline);
                border-radius: var(--rounded-md);
                padding: 16px;
                margin-bottom: 12px;
                background: var(--color-canvas-soft);
            }
            .entry-row-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
            }
            .btn-small { font-size: 12px; padding: 4px 10px; }
            .entry-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
            .modal-footer .btn-primary { margin-right: 8px; }
            .modal-overlay { cursor: pointer; }
            .modal-content { cursor: default; }
            .locked-notice { background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--rounded-md); padding: 12px; font-size: 13px; color: #92400e; margin-bottom: 16px; }
            .loading { text-align: center; padding: 40px; color: var(--color-body); }
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
            @media (max-width: 768px) { .entry-grid { grid-template-columns: 1fr; } }
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
                <a href="{{ route('applicant.dashboard') }}" class="nav-link active">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('applicant.jobs') }}" class="nav-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Job Openings
                </a>
                <a href="{{ route('applicant.profile') }}" class="nav-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Profile
                </a>
            </nav>
            <div style="margin-top: auto;">
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</div>
                    <div>
                        <div class="user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                        <div class="user-role">Applicant</div>
                    </div>
                </div>
                <button type="button" class="logout-btn" onclick="showLogoutConfirm()">Sign Out</button>
            </div>
        </aside>
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Welcome back, {{ auth()->user()->first_name }}!</h1>
                <p class="page-subtitle">Here's an overview of your application status</p>
            </div>

            @if(session('success'))
                <div class="toast show">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="toast show error">{{ session('error') }}</div>
            @endif

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Applications</div>
                    <div class="stat-value">{{ $stats['total'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Pending</div>
                    <div class="stat-value">{{ $stats['pending'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Qualified</div>
                    <div class="stat-value">{{ $stats['qualified'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Disqualified</div>
                    <div class="stat-value">{{ $stats['disqualified'] }}</div>
                </div>
            </div>

            <div class="card">
                <h2 class="card-title" style="font-size: 16px; font-weight: 600; margin-bottom: 16px;">My Applications</h2>
                @if($applications->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Application Code</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                                <tr>
                                    <td style="font-weight: 500;">{{ $app->application_code }}</td>
                                    <td>{{ $app->job->plantillaPosition->position_name ?? '-' }}</td>
                                    <td>{{ $app->job->plantillaPosition->department ?? '-' }}</td>
                                    <td>{{ $app->created_at->format('M d, Y') }}</td>
                                    <td><span class="badge badge-{{ $app->status }}">{{ ucfirst($app->status) }}</span></td>
                                    <td>
                                        <button type="button" class="btn-secondary" style="padding: 4px 10px; font-size: 12px;" onclick="openViewModal({{ $app->id }})">View</button>
                                        @if($app->status === 'pending')
                                            <button type="button" class="btn-primary" style="padding: 4px 10px; font-size: 12px; margin-left: 4px;" onclick="openEditModal({{ $app->id }})">Edit</button>
                                            <button type="button" class="btn-danger" style="margin-left: 4px;" onclick="showWithdrawConfirm({{ $app->id }})">Withdraw</button>
                                        @else
                                            <span style="color: var(--color-muted); font-size: 13px; margin-left: 8px;">Locked</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="color: var(--color-body); text-align: center; padding: 40px;">No applications yet. <a href="{{ route('applicant.jobs') }}" style="color: var(--color-primary);">Browse available jobs</a></p>
                @endif
            </div>
        </main>

        <!-- Withdraw Confirmation -->
        <div class="confirm-overlay" id="withdrawConfirm">
            <div class="confirm-box">
                <h3 class="confirm-title">Withdraw Application</h3>
                <p class="confirm-message">Are you sure you want to withdraw this application? This action cannot be undone.</p>
                <div class="confirm-buttons">
                    <button type="button" class="confirm-btn confirm-btn-cancel" onclick="hideWithdrawConfirm()">Cancel</button>
                    <button type="button" class="confirm-btn confirm-btn-danger" id="confirmWithdrawBtn">Withdraw</button>
                </div>
            </div>
        </div>

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

        <!-- View Modal -->
        <div class="modal-overlay" id="viewModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="viewModalTitle">Application Details</h2>
                    <button class="modal-close" onclick="closeViewModal()">&times;</button>
                </div>
                <div class="modal-body" id="viewModalBody">
                    <div class="loading">Loading...</div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal-overlay" id="editModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Edit Application</h2>
                    <button class="modal-close" onclick="closeEditModal()">&times;</button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="loading">Loading...</div>
                </div>
                <div class="modal-footer" style="padding: 16px 24px; border-top: 1px solid #f0f0f3; display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" onclick="closeEditModal()" style="padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; border: none; background: #f0f0f3; color: #171717;">Cancel</button>
                    <button type="button" onclick="saveApplication()" style="padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; border: none; background: #0057B8; color: white;">Save Changes</button>
                </div>
            </div>
        </div>

        <div class="toast" id="toast"></div>

        <script>
            @if(session('success'))
            showToast('{{ session('success') }}');
            @endif
            @if(session('error'))
            showToast('{{ session('error') }}', true);
            @endif
            function showLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.add('show');
            }
            function hideLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.remove('show');
            }
            let withdrawForm = null;
            function showWithdrawConfirm(id) {
                withdrawForm = document.querySelector('form[action*="/applicant/applications/" + id]');
                document.getElementById('withdrawConfirm').classList.add('show');
            }
            function hideWithdrawConfirm() {
                document.getElementById('withdrawConfirm').classList.remove('show');
            }
            document.getElementById('confirmWithdrawBtn').addEventListener('click', function() {
                if (withdrawForm) withdrawForm.submit();
            });

            // View Modal
            let currentAppId = null;
            async function openViewModal(appId) {
                currentAppId = appId;
                document.getElementById('viewModal').classList.add('show');
                document.getElementById('viewModalBody').innerHTML = '<div class="loading">Loading...</div>';
                
                try {
                    const response = await fetch(`/applicant/applications/${appId}`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    if (!response.ok) throw new Error('Failed to load');
                    const app = await response.json();
                    renderViewModal(app);
                } catch (error) {
                    console.error(error);
                    document.getElementById('viewModalBody').innerHTML = '<div class="loading">Error loading: ' + error.message + '</div>';
                }
            }
            function closeViewModal() {
                document.getElementById('viewModal').classList.remove('show');
            }
            document.getElementById('viewModal').addEventListener('click', function(e) {
                if (e.target === this) closeViewModal();
            });

            function renderViewModal(app) {
                const body = document.getElementById('viewModalBody');
                const createdAt = new Date(app.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                
                let html = `
                    <div class="info-row">
                        <span class="info-label">Application Code</span>
                        <span class="info-value">${app.application_code}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Position</span>
                        <span class="info-value">${app.job?.plantilla_position?.position_name || '-'}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Department</span>
                        <span class="info-value">${app.job?.plantilla_position?.department || '-'}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Submitted</span>
                        <span class="info-value">${createdAt}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value"><span class="badge badge-${app.status}">${app.status}</span></span>
                    </div>
                `;

                if (app.status !== 'pending') {
                    html += `<div class="locked-notice">This application has been ${app.status} and cannot be edited.</div>`;
                }

                // Education
                if (app.educations && app.educations.length > 0) {
                    html += `<div class="section-title">Education</div>`;
                    app.educations.forEach(edu => {
                        const fileUrl = edu.file_path ? `/storage/${edu.file_path}` : null;
                        html += `
                            <div class="entry-item">
                                <div class="entry-title">${edu.level}</div>
                                <div class="entry-detail">${edu.school_name}${edu.course ? ' - ' + edu.course : ''} (${edu.year_graduated})</div>
                                ${fileUrl ? `<a href="${fileUrl}" target="_blank" class="entry-file"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : ''}
                            </div>
                        `;
                    });
                }

                // Training
                if (app.trainings && app.trainings.length > 0) {
                    html += `<div class="section-title">Training</div>`;
                    app.trainings.forEach(train => {
                        const fileUrl = train.file_path ? `/storage/${train.file_path}` : null;
                        html += `
                            <div class="entry-item">
                                <div class="entry-title">${train.training_title}</div>
                                <div class="entry-detail">${train.training_hours || ''} hours${train.date_conducted ? ' - ' + train.date_conducted : ''}</div>
                                ${fileUrl ? `<a href="${fileUrl}" target="_blank" class="entry-file"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : ''}
                            </div>
                        `;
                    });
                }

                // Experience
                if (app.experiences && app.experiences.length > 0) {
                    html += `<div class="section-title">Work Experience</div>`;
                    app.experiences.forEach(exp => {
                        const fileUrl = exp.file_path ? `/storage/${exp.file_path}` : null;
                        html += `
                            <div class="entry-item">
                                <div class="entry-title">${exp.position} at ${exp.employer}</div>
                                <div class="entry-detail">${exp.start_date}${exp.is_present ? ' - Present' : (exp.end_date ? ' - ' + exp.end_date : '')}${exp.sector ? ' | ' + exp.sector : ''}</div>
                                ${fileUrl ? `<a href="${fileUrl}" target="_blank" class="entry-file"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : ''}
                            </div>
                        `;
                    });
                }

                // Eligibility
                if (app.eligibilities && app.eligibilities.length > 0) {
                    html += `<div class="section-title">Eligibility</div>`;
                    app.eligibilities.forEach(elig => {
                        const fileUrl = elig.file_path ? `/storage/${elig.file_path}` : null;
                        html += `
                            <div class="entry-item">
                                <div class="entry-title">${elig.eligibility_type?.name || 'Other'}</div>
                                <div class="entry-detail">${elig.license_no ? 'License: ' + elig.license_no : ''}${elig.date_issued ? ' | Issued: ' + elig.date_issued : ''}</div>
                                ${fileUrl ? `<a href="${fileUrl}" target="_blank" class="entry-file"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : ''}
                            </div>
                        `;
                    });
                }

                // Documents
                if (app.documents && app.documents.length > 0) {
                    html += `<div class="section-title">Other Requirements</div>`;
                    app.documents.forEach(doc => {
                        const fileUrl = doc.file_path ? `/storage/${doc.file_path}` : null;
                        html += `
                            <div class="entry-item">
                                <div class="entry-title">${doc.document_type?.name || 'Document'}</div>
                                ${fileUrl ? `<a href="${fileUrl}" target="_blank" class="entry-file"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : ''}
                            </div>
                        `;
                    });
                }

                body.innerHTML = html;
            }

            // Edit Modal
            let editAppData = null;
            let editEligibilityTypes = [];

            async function openEditModal(appId) {
                currentAppId = appId;
                document.getElementById('editModal').classList.add('show');
                document.getElementById('editModalBody').innerHTML = '<div class="loading">Loading...</div>';
                
                try {
                    const response = await fetch(`/applicant/applications/${appId}/edit`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    if (!response.ok) throw new Error('Failed to load');
                    const data = await response.json();
                    editAppData = data.application;
                    editEligibilityTypes = data.eligibilityTypes || [];
                    renderEditModal(data.application);
                } catch (error) {
                    console.error(error);
                    document.getElementById('editModalBody').innerHTML = '<div class="loading">Error loading: ' + error.message + '</div>';
                }
            }
            function closeEditModal() {
                document.getElementById('editModal').classList.remove('show');
            }
            document.getElementById('editModal').addEventListener('click', function(e) {
                if (e.target === this) closeEditModal();
            });

            function renderEditModal(app) {
                const body = document.getElementById('editModalBody');
                let html = `<form id="editForm" style="padding: 0 20px;" onsubmit="return false;">
                    <div style="margin-bottom: 20px; padding: 16px; background: #f5f5f7; border-radius: 8px;">
                        <h3 style="font-size: 16px; margin-bottom: 4px;">${app.job?.plantilla_position?.position_name || 'Position'}</h3>
                        <p style="font-size: 14px; color: #60646c;">${app.job?.plantilla_position?.department || ''}</p>
                    </div>`;

                // Education
                html += `<h4 style="font-size: 16px; font-weight: 600; margin: 20px 0 12px; color: #0057B8;">Education</h4>`;
                html += `<div id="education-entries">`;
                if (app.educations && app.educations.length > 0) {
                    app.educations.forEach((edu, index) => {
                        html += renderEducationRow(edu, index);
                    });
                }
                html += `</div>`;
                html += `<button type="button" class="btn-add" onclick="addEducation()" style="background: #f0f0f3; color: #171717; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500; margin-top: 10px;">+ Add Education</button>`;

                // Training
                html += `<h4 style="font-size: 16px; font-weight: 600; margin: 20px 0 12px; color: #0057B8;">Training</h4>`;
                html += `<div id="training-entries">`;
                if (app.trainings && app.trainings.length > 0) {
                    app.trainings.forEach((train, index) => {
                        html += renderTrainingRow(train, index);
                    });
                }
                html += `</div>`;
                html += `<button type="button" class="btn-add" onclick="addTraining()" style="background: #f0f0f3; color: #171717; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500; margin-top: 10px;">+ Add Training</button>`;

                // Experience
                html += `<h4 style="font-size: 16px; font-weight: 600; margin: 20px 0 12px; color: #0057B8;">Work Experience</h4>`;
                html += `<div id="experience-entries">`;
                if (app.experiences && app.experiences.length > 0) {
                    app.experiences.forEach((exp, index) => {
                        html += renderExperienceRow(exp, index);
                    });
                }
                html += `</div>`;
                html += `<button type="button" class="btn-add" onclick="addExperience()" style="background: #f0f0f3; color: #171717; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500; margin-top: 10px;">+ Add Experience</button>`;

                // Eligibility
                html += `<h4 style="font-size: 16px; font-weight: 600; margin: 20px 0 12px; color: #0057B8;">Eligibility</h4>`;
                html += `<div id="eligibility-entries">`;
                if (app.eligibilities && app.eligibilities.length > 0) {
                    app.eligibilities.forEach((elig, index) => {
                        html += renderEligibilityRow(elig, index);
                    });
                }
                html += `</div>`;
                html += `<button type="button" class="btn-add" onclick="addEligibility()" style="background: #f0f0f3; color: #171717; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500; margin-top: 10px;">+ Add Eligibility</button>`;

                // Other Requirements (Documents)
                html += `<h4 style="font-size: 16px; font-weight: 600; margin: 20px 0 12px; color: #0057B8;">Other Requirements</h4>`;
                html += `<div id="documents-entries">`;
                if (app.documents && app.documents.length > 0) {
                    app.documents.forEach((doc, index) => {
                        html += renderDocumentRow(doc, index);
                    });
                } else {
                    html += `<p style="color: #999; font-size: 13px; font-style: italic;">No documents required for this position.</p>`;
                }
                html += `</div>`;

                html += `</form>`;
                body.innerHTML = html;
            }

            function renderEducationRow(edu = null, index = 0) {
                const existingFile = edu?.file_path ? `<a href="/storage/${edu.file_path}" target="_blank" style="color: #0057B8; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; text-decoration: none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
                return `
                    <div style="border: 1px solid #f0f0f3; border-radius: 8px; padding: 20px; margin-bottom: 16px; background: #fafafa;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="font-weight: 500; font-size: 14px;">Education</span>
                            <button type="button" onclick="this.closest('div').remove()" style="color: #dc2626; background: none; border: none; cursor: pointer; font-size: 13px;">Remove</button>
                        </div>
                        <input type="hidden" name="educations[${index}][id]" value="${edu?.id || ''}">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Level</label>
                                <select name="educations[${index}][level]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;">
                                    <option value="Elementary" ${edu?.level == 'Elementary' ? 'selected' : ''}>Elementary</option>
                                    <option value="High School" ${edu?.level == 'High School' ? 'selected' : ''}>High School</option>
                                    <option value="Senior High School" ${edu?.level == 'Senior High School' ? 'selected' : ''}>Senior High School</option>
                                    <option value="Bachelors" ${!edu || edu?.level == 'Bachelors' ? 'selected' : ''}>Bachelors</option>
                                    <option value="Masters" ${edu?.level == 'Masters' ? 'selected' : ''}>Masters</option>
                                    <option value="Doctorate" ${edu?.level == 'Doctorate' ? 'selected' : ''}>Doctorate</option>
                                </select>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Year Graduated</label>
                                <input type="number" name="educations[${index}][year_graduated]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${edu?.year_graduated || ''}" min="1900" max="2099">
                            </div>
                            <div style="margin-bottom: 16px; grid-column: 1 / -1;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">School Name *</label>
                                <input type="text" name="educations[${index}][school_name]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${edu?.school_name || ''}" required>
                            </div>
                            <div style="margin-bottom: 16px; grid-column: 1 / -1;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Course</label>
                                <input type="text" name="educations[${index}][course]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${edu?.course || ''}">
                            </div>
                            <div style="margin-bottom: 16px; grid-column: 1 / -1;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Document (PDF, JPG, PNG)</label>
                                <input type="file" name="educations[${index}][file]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" accept=".pdf,.jpg,.jpeg,.png">
                                ${existingFile}
                            </div>
                        </div>
                    </div>
                `;
            }

            function renderTrainingRow(train = null, index = 0) {
                const existingFile = train?.file_path ? `<a href="/storage/${train.file_path}" target="_blank" style="color: #0057B8; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; text-decoration: none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
                return `
                    <div style="border: 1px solid #f0f0f3; border-radius: 8px; padding: 20px; margin-bottom: 16px; background: #fafafa;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="font-weight: 500; font-size: 14px;">Training</span>
                            <button type="button" onclick="this.closest('div').remove()" style="color: #dc2626; background: none; border: none; cursor: pointer; font-size: 13px;">Remove</button>
                        </div>
                        <input type="hidden" name="trainings[${index}][id]" value="${train?.id || ''}">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                            <div style="margin-bottom: 16px; grid-column: 1 / -1;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Training Title *</label>
                                <input type="text" name="trainings[${index}][training_title]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${train?.training_title || ''}" required>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Hours</label>
                                <input type="number" name="trainings[${index}][training_hours]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${train?.training_hours || ''}">
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Date</label>
                                <input type="date" name="trainings[${index}][date_conducted]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${train?.date_conducted || ''}">
                            </div>
                            <div style="margin-bottom: 16px; grid-column: 1 / -1;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Document (PDF, JPG, PNG)</label>
                                <input type="file" name="trainings[${index}][file]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" accept=".pdf,.jpg,.jpeg,.png">
                                ${existingFile}
                            </div>
                        </div>
                    </div>
                `;
            }

            function renderExperienceRow(exp = null, index = 0) {
                const existingFile = exp?.file_path ? `<a href="/storage/${exp.file_path}" target="_blank" style="color: #0057B8; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; text-decoration: none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
                return `
                    <div style="border: 1px solid #f0f0f3; border-radius: 8px; padding: 20px; margin-bottom: 16px; background: #fafafa;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="font-weight: 500; font-size: 14px;">Work Experience</span>
                            <button type="button" onclick="this.closest('div').remove()" style="color: #dc2626; background: none; border: none; cursor: pointer; font-size: 13px;">Remove</button>
                        </div>
                        <input type="hidden" name="experiences[${index}][id]" value="${exp?.id || ''}">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Position *</label>
                                <input type="text" name="experiences[${index}][position]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${exp?.position || ''}" required>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Employer *</label>
                                <input type="text" name="experiences[${index}][employer]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${exp?.employer || ''}" required>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Start Date *</label>
                                <input type="date" name="experiences[${index}][start_date]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${exp?.start_date || ''}" required>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">End Date</label>
                                <input type="date" name="experiences[${index}][end_date]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${exp?.end_date || ''}" ${exp?.is_present ? 'disabled' : ''}>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: flex; align-items: center; gap: 8px; font-size: 14px;">
                                    <input type="checkbox" name="experiences[${index}][is_present]" value="1" ${exp?.is_present ? 'checked' : ''} onchange="toggleEndDate(this)"> Currently Working
                                </label>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Sector</label>
                                <select name="experiences[${index}][sector]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;">
                                    <option value="">Select</option>
                                    <option value="Government" ${exp?.sector == 'Government' ? 'selected' : ''}>Government</option>
                                    <option value="Private" ${exp?.sector == 'Private' ? 'selected' : ''}>Private</option>
                                    <option value="Academic" ${exp?.sector == 'Academic' ? 'selected' : ''}>Academic</option>
                                    <option value="NGO" ${exp?.sector == 'NGO' ? 'selected' : ''}>NGO</option>
                                </select>
                            </div>
                            <div style="margin-bottom: 16px; grid-column: 1 / -1;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Document (PDF, JPG, PNG)</label>
                                <input type="file" name="experiences[${index}][file]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" accept=".pdf,.jpg,.jpeg,.png">
                                ${existingFile}
                            </div>
                        </div>
                    </div>
                `;
            }

            function renderEligibilityRow(elig = null, index = 0) {
                const existingFile = elig?.file_path ? `<a href="/storage/${elig.file_path}" target="_blank" style="color: #0057B8; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; text-decoration: none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
                
                let eligOptions = '<option value="">Select Eligibility</option>';
                editEligibilityTypes.forEach(type => {
                    const isSelected = elig?.eligibility_type_id == type.id || elig?.eligibility_type?.name === type.name;
                    eligOptions += `<option value="${type.id}" ${isSelected ? 'selected' : ''}>${type.name}</option>`;
                });

                return `
                    <div style="border: 1px solid #f0f0f3; border-radius: 8px; padding: 20px; margin-bottom: 16px; background: #fafafa;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="font-weight: 500; font-size: 14px;">Eligibility</span>
                            <button type="button" onclick="this.closest('div').remove()" style="color: #dc2626; background: none; border: none; cursor: pointer; font-size: 13px;">Remove</button>
                        </div>
                        <input type="hidden" name="eligibilities[${index}][id]" value="${elig?.id || ''}">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Eligibility Type</label>
                                <select name="eligibilities[${index}][eligibility_type_id]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;">
                                    ${eligOptions}
                                </select>
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">License No</label>
                                <input type="text" name="eligibilities[${index}][license_no]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${elig?.license_no || ''}">
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Date Issued</label>
                                <input type="date" name="eligibilities[${index}][date_issued]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" value="${elig?.date_issued || ''}">
                            </div>
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Document (PDF, JPG, PNG)</label>
                                <input type="file" name="eligibilities[${index}][file]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" accept=".pdf,.jpg,.jpeg,.png">
                                ${existingFile}
                            </div>
                        </div>
                    </div>
                `;
            }

            function renderDocumentRow(doc = null, index = 0) {
                const existingFile = doc?.file_path ? `<a href="/storage/${doc.file_path}" target="_blank" style="color: #0057B8; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; text-decoration: none;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
                return `
                    <div style="border: 1px solid #f0f0f3; border-radius: 8px; padding: 20px; margin-bottom: 16px; background: #fafafa;">
                        <div style="margin-bottom: 12px;">
                            <span style="font-weight: 500; font-size: 14px;">${doc?.document_type?.name || 'Document'}</span>
                            ${doc?.document_type?.is_required ? '<span style="color: #dc2626; font-size: 12px; margin-left: 4px;">*</span>' : ''}
                        </div>
                        <input type="hidden" name="documents[${index}][id]" value="${doc?.id || ''}">
                        <input type="hidden" name="documents[${index}][document_type_id]" value="${doc?.document_type_id || ''}">
                        <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Upload File (PDF, JPG, PNG)</label>
                        <input type="file" name="documents[${index}][file]" style="width: 100%; padding: 12px 14px; border: 1px solid #dcdee0; border-radius: 8px; font-size: 14px; font-family: inherit;" accept=".pdf,.jpg,.jpeg,.png">
                        ${existingFile}
                    </div>
                `;
            }

            let eduCount = 0;
            let trainCount = 0;
            let expCount = 0;
            let eligCount = 0;

            function addEducation() {
                const div = document.createElement('div');
                div.innerHTML = renderEducationRow(null, eduCount++);
                document.getElementById('education-entries').appendChild(div.firstElementChild);
            }
            function addTraining() {
                const div = document.createElement('div');
                div.innerHTML = renderTrainingRow(null, trainCount++);
                document.getElementById('training-entries').appendChild(div.firstElementChild);
            }
            function addExperience() {
                const div = document.createElement('div');
                div.innerHTML = renderExperienceRow(null, expCount++);
                document.getElementById('experience-entries').appendChild(div.firstElementChild);
            }
            function addEligibility() {
                const div = document.createElement('div');
                div.innerHTML = renderEligibilityRow(null, eligCount++);
                document.getElementById('eligibility-entries').appendChild(div.firstElementChild);
            }

            function toggleEndDate(checkbox) {
                const endDateInput = checkbox.closest('.entry-grid').querySelector('input[name*="end_date"]');
                endDateInput.disabled = checkbox.checked;
                if (checkbox.checked) endDateInput.value = '';
            }

            async function saveApplication() {
                const form = document.getElementById('editForm');
                const formData = new FormData(form);
                
                try {
                    const response = await fetch(`/applicant/applications/${currentAppId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    
                    if (response.ok) {
                        const data = await response.json();
                        showToast(data.success || 'Application saved successfully!');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        const data = await response.json();
                        showToast(data.error || 'Error saving', true);
                    }
                } catch (error) {
                    showToast('Error saving', true);
                }
            }

            function showToast(message, isError = false) {
                const toast = document.getElementById('toast');
                toast.textContent = message;
                toast.className = 'toast' + (isError ? ' error' : '');
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3000);
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeViewModal();
                    closeEditModal();
                }
            });
        </script>
    </body>
</html>