<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>User Management - DEPED Region V Recruitment</title>
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
            .main-content { margin-left: 240px; padding: 24px 32px; min-height: 100vh; }
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
            .sidebar-footer { margin-top: auto; }
            .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-start; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
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
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 24px; margin-bottom: 24px; }
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; }
            .data-table { width: 100%; border-collapse: collapse; }
            .data-table th { text-align: left; padding: 12px; font-size: 12px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--color-hairline); }
            .data-table td { padding: 12px; font-size: 14px; border-bottom: 1px solid var(--color-hairline); vertical-align: middle; }
            .data-table tr:last-child td { border-bottom: none; }
            .data-table tr:hover td { background: var(--color-canvas-soft); }
            .badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
            .badge-applicant { background: #dbeafe; color: #1e40af; }
            .badge-hr { background: #dcfce7; color: #166534; }
            .badge-board { background: #fef3c7; color: #92400e; }
            .badge-admin { background: #f3e8ff; color: #7c3aed; }
            .badge-active { background: #dcfce7; color: #166534; }
            .badge-pending { background: #fef3c7; color: #92400e; }
            .badge-inactive { background: #f3f4f6; color: #6b7280; }
            .badge-suspended { background: #fce7f3; color: #be185d; }
            .filter-bar { display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; align-items: center; }
            .search-input { background: var(--color-surface-card); border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); padding: 10px 16px; font-size: 14px; min-width: 280px; height: 40px; }
            .search-input:focus { outline: none; border-color: var(--color-ink); }
            .select-input { background: var(--color-surface-card); border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); padding: 8px 12px; font-size: 14px; height: 40px; }
            .select-input:focus { outline: none; border-color: var(--color-ink); }
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
            .btn-success { background: #dcfce7; color: #166534; }
            .btn-warning { background: #fef3c7; color: #92400e; }
            .btn-sm {
                padding: 4px 10px;
                font-size: 12px;
                height: 30px;
            }
            .role-form { display: flex; align-items: center; gap: 6px; }
            .inline-select { padding: 4px 8px; font-size: 12px; border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); height: 30px; cursor: pointer; }
            .inline-select:focus { outline: none; border-color: var(--color-ink); }
            .pagination { display: flex; justify-content: center; gap: 4px; margin-top: 20px; }
            .pagination a, .pagination span { padding: 6px 12px; border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); text-decoration: none; font-size: 13px; color: var(--color-body); }
            .pagination a:hover { background: var(--color-surface-strong); }
            .pagination .active { background: var(--color-primary); color: white; border-color: var(--color-primary); }
            .alert { padding: 12px 16px; border-radius: var(--rounded-md); font-size: 14px; margin-bottom: 16px; }
            .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
            .status-actions { display: flex; gap: 4px; flex-wrap: wrap; }
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users') }}" class="nav-link {{ Route::is('admin.users') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Users</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</div>
                    <div>
                        <div class="user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                        <div class="user-role">Admin</div>
                    </div>
                </div>
                <button type="button" class="logout-btn" onclick="showLogoutConfirm()">Sign Out</button>
            </div>
        </aside>
        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1 class="page-title">User Management</h1>
                    <p class="page-subtitle">Manage system users, roles, and account status</p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Search / Filter -->
            <form method="GET" action="{{ route('admin.users') }}" class="filter-bar">
                <input type="text" name="search" class="search-input" placeholder="Search by name or email..." value="{{ request('search') }}">
                <select name="role" class="select-input" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="applicant" {{ request('role') === 'applicant' ? 'selected' : '' }}>Applicant</option>
                    <option value="hr" {{ request('role') === 'hr' ? 'selected' : '' }}>HR</option>
                    <option value="board" {{ request('role') === 'board' ? 'selected' : '' }}>Board</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <select name="status" class="select-input" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
                @if (request()->anyFilled(['search', 'role', 'status']))
                    <a href="{{ route('admin.users') }}" class="btn-sm btn-secondary" style="display: inline-flex; align-items: center; text-decoration: none;">Clear</a>
                @endif
            </form>

            <!-- Users Table -->
            <div class="card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div style="font-weight: 500;">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    @if ($user->extension_name)
                                        <div style="font-size: 12px; color: var(--color-muted);">{{ $user->extension_name }}</div>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="role-form">
                                        @csrf
                                        <select name="role" class="inline-select" onchange="this.form.submit()">
                                            <option value="applicant" {{ $user->role === 'applicant' ? 'selected' : '' }}>Applicant</option>
                                            <option value="hr" {{ $user->role === 'hr' ? 'selected' : '' }}>HR</option>
                                            <option value="board" {{ $user->role === 'board' ? 'selected' : '' }}>Board</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $user->status }}">{{ ucfirst($user->status) }}</span>
                                    <div class="status-actions" style="margin-top: 4px;">
                                        @if ($user->status !== 'active')
                                            <form method="POST" action="{{ route('admin.users.update-status', $user) }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="btn-sm btn-success">Activate</button>
                                            </form>
                                        @endif
                                        @if ($user->status !== 'inactive' && $user->status !== 'suspended')
                                            <form method="POST" action="{{ route('admin.users.update-status', $user) }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="inactive">
                                                <button type="submit" class="btn-sm btn-secondary">Deactivate</button>
                                            </form>
                                        @endif
                                        @if ($user->status !== 'suspended')
                                            <form method="POST" action="{{ route('admin.users.update-status', $user) }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="suspended">
                                                <button type="submit" class="btn-sm btn-danger">Suspend</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                                <td style="font-size: 13px; color: var(--color-body);">{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--color-muted); padding: 48px;">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="pagination">
                    {{ $users->links() }}
                </div>
            @endif
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
            document.getElementById('logoutConfirm').addEventListener('click', function(e) {
                if (e.target === this) hideLogoutConfirm();
            });
        </script>
    </body>
</html>
