<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>HR Dashboard - DEPED Region V Recruitment</title>
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
                cursor: pointer;
            }
            .nav-link:hover { background: var(--color-surface-strong); color: var(--color-ink); }
            .nav-link.active { background: var(--color-primary); color: white; }
            .nav-section { font-size: 11px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; margin: 20px 12px 8px; }
            .sidebar-footer { margin-top: auto; }
            .page-header { margin-bottom: 24px; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
            .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
            .stat-card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 20px; }
            .stat-label { font-size: 13px; color: var(--color-muted); margin-bottom: 4px; }
            .stat-value { font-size: 28px; font-weight: 600; }
            .stat-sub { font-size: 12px; }
            .stat-sub.success { color: var(--color-semantic-success); }
            .stat-sub.warning { color: var(--color-semantic-warning); }
            .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
            .section-title { font-size: 16px; font-weight: 600; }
            .section-link { font-size: 14px; color: var(--color-primary); text-decoration: none; }
            .section-link:hover { text-decoration: underline; }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 24px; margin-bottom: 24px; }
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; }
            .data-table { width: 100%; border-collapse: collapse; }
            .data-table th { text-align: left; padding: 12px; font-size: 12px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--color-hairline); }
            .data-table td { padding: 12px; font-size: 14px; border-bottom: 1px solid var(--color-hairline); }
            .data-table tr:last-child td { border-bottom: none; }
            .data-table tr:hover td { background: var(--color-canvas-soft); }
            .badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
            .badge-open { background: #dcfce7; color: #166534; }
            .badge-closed { background: #f3f4f6; color: #6b7280; }
            .badge-pending { background: #fef3c7; color: #92400e; }
            .badge-reviewed { background: #dbeafe; color: #1e40af; }
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 36px; height: 36px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px; }
            .user-name { font-weight: 500; font-size: 14px; }
            .user-role { font-size: 12px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; width: 100%; text-align: left; }
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
            .confirm-btn-logout { background: #dc2626; color: white; }
            .content-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
            @media (max-width: 1024px) {
                .stats-grid { grid-template-columns: repeat(2, 1fr); }
                .content-grid { grid-template-columns: 1fr; }
            }
            @media (max-width: 768px) {
                .sidebar { width: 64px; padding: 24px 8px; }
                .sidebar .logo-text, .sidebar .nav-link span, .sidebar .nav-section, .sidebar .user-info, .sidebar .logout-btn { display: none; }
                .main-content { margin-left: 64px; }
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
                <h1 class="page-title">HR Dashboard</h1>
                <p class="page-subtitle">Overview of recruitment activities</p>
            </div>

<!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Open Positions</div>
                    <div class="stat-value">{{ $openPositions }}</div>
                    <div class="stat-sub success">{{ $thisMonthApplications }} this month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Applications</div>
                    <div class="stat-value">{{ $totalApplications }}</div>
                    <div class="stat-sub">All time</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Pending Review</div>
                    <div class="stat-value">{{ $pendingApplications }}</div>
                    <div class="stat-sub warning">{{ $pendingApplications > 0 ? 'Needs attention' : 'All caught up' }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Qualified</div>
                    <div class="stat-value">{{ $qualifiedApplications }}</div>
                    <div class="stat-sub success">{{ $qualifiedApplications > 0 ? 'Passed evaluation' : 'No qualified yet' }}</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Recent Job Postings -->
                <div class="card">
                    <div class="section-header">
                        <h2 class="card-title">Recent Job Postings</h2>
                        <a href="{{ route('hr.job-postings') }}" class="section-link">View All</a>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Applicants</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentJobs as $job)
                            <tr>
                                <td>{{ $job->plantillaPosition->position_name ?? '-' }}</td>
                                <td>{{ $job->plantillaPosition->department ?? '-' }}</td>
                                <td><span class="badge badge-{{ $job->status }}">{{ ucfirst($job->status) }}</span></td>
                                <td>{{ $job->applications_count ?? $job->applications->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--color-muted);">No job postings yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

<!-- Recent Applications -->
                <div class="card">
                    <div class="section-header">
                        <h2 class="card-title">Recent Applications</h2>
                        <a href="#" class="section-link">View All</a>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications as $app)
                            <tr>
                                <td>{{ $app->user->first_name ?? '-' }} {{ $app->user->last_name ?? '' }}</td>
                                <td>{{ $app->job->plantillaPosition->position_name ?? '-' }}</td>
                                <td><span class="badge badge-{{ $app->status === 'pending' ? 'pending' : ($app->status === 'qualified' ? 'reviewed' : 'closed') }}">{{ ucfirst($app->status) }}</span></td>
                                <td>{{ $app->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--color-muted);">No applications yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
                
                </div>
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
        </script>
    </body>
</html>