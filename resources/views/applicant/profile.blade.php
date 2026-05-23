<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile - DEPED Region V Recruitment</title>
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
            .page-header { margin-bottom: 24px; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 24px; margin-bottom: 24px; }
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 20px; }
            .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
            .form-group { margin-bottom: 16px; }
            .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; }
            .form-input, .form-select, .form-textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                font-size: 14px;
                font-family: var(--font-sans);
            }
            .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--color-primary); }
            .checkbox-group { display: flex; gap: 8px; align-items: center; }
            .checkbox-group input { width: auto; }
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
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); margin-top: auto; }
            .user-avatar { width: 40px; height: 40px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; }
            .user-name { font-weight: 500; }
            .user-role { font-size: 13px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; }
            .logout-btn:hover { color: #dc2626; }
            .confirm-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; }
            .confirm-overlay.show { display: flex; }
            .confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 400px; text-align: center; }
            .confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
            .confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
            .confirm-buttons { display: flex; gap: 12px; justify-content: center; }
            .confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
            .confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
            .confirm-btn-logout { background: #dc2626; color: white; }
            .alert { padding: 12px 16px; border-radius: var(--rounded-md); margin-bottom: 20px; font-size: 14px; }
            .alert-success { background: #dcfce7; color: #166534; }
            .info-row { display: flex; padding: 12px 0; border-bottom: 1px solid var(--color-hairline); }
            .info-row:last-child { border-bottom: none; }
            .info-label { width: 200px; color: var(--color-body); font-size: 14px; }
            .info-value { font-weight: 500; font-size: 14px; }
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
                <a href="{{ route('applicant.dashboard') }}" class="nav-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('applicant.jobs') }}" class="nav-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Job Openings
                </a>
                <a href="{{ route('applicant.profile') }}" class="nav-link active">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Profile
                </a>
            </nav>
            <div class="user-info" style="margin-top: auto;">
                <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                    <div class="user-role">Applicant</div>
                </div>
            </div>
            <button type="button" class="logout-btn" onclick="showLogoutConfirm()">Sign Out</button>
        </aside>
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">My Profile</h1>
                <p class="page-subtitle">Manage your personal information</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('applicant.update-profile') }}">
                @csrf

                <div class="card">
                    <div class="card-title">Account Information</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-input" value="{{ auth()->user()->first_name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-input" value="{{ auth()->user()->last_name }}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" value="{{ auth()->user()->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-input" value="Applicant" disabled>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Personal Details</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-input" value="{{ $profile->date_of_birth ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select</option>
                                <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Civil Status</label>
                            <select name="civil_status" class="form-select">
                                <option value="">Select</option>
                                <option value="Single" {{ ($profile->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ ($profile->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Widowed" {{ ($profile->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                <option value="Separated" {{ ($profile->civil_status ?? '') == 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Annulled" {{ ($profile->civil_status ?? '') == 'Annulled' ? 'selected' : '' }}>Annulled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Citizenship</label>
                            <input type="text" name="citizenship" class="form-input" value="{{ $profile->citizenship ?? '' }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Religion</label>
                            <input type="text" name="religion" class="form-input" value="{{ $profile->religion ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-input" value="{{ $profile->contact_number ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 16px;">
                        <label class="checkbox-group">
                            <input type="checkbox" name="is_person_with_disability" value="1" {{ ($profile->is_person_with_disability ?? false) ? 'checked' : '' }}>
                            <span>Person with Disability (PWD)</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-group">
                            <input type="checkbox" name="is_solo_parent" value="1" {{ ($profile->is_solo_parent ?? false) ? 'checked' : '' }}>
                            <span>Solo Parent</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-group">
                            <input type="checkbox" name="is_member_of_indigenous_people" value="1" {{ ($profile->is_member_of_indigenous_people ?? false) ? 'checked' : '' }}>
                            <span>Member of Indigenous People</span>
                        </label>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Address</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Region</label>
                            <input type="text" name="region" class="form-input" value="{{ $profile->region ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Province</label>
                            <input type="text" name="province" class="form-input" value="{{ $profile->province ?? '' }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">City/Municipality</label>
                            <input type="text" name="city" class="form-input" value="{{ $profile->city ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Barangay</label>
                            <input type="text" name="barangay" class="form-input" value="{{ $profile->barangay ?? '' }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-input" value="{{ $profile->zip_code ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Current Address</label>
                            <textarea name="current_address" class="form-textarea">{{ $profile->current_address ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Save Changes</button>
            </form>
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