<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>Edit Application - DEPED Region V Recruitment</title>
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
            .main-content { margin-left: 240px; padding: 24px 32px; max-width: 1000px; }
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
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center; }
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
            .form-input:focus, .form-select:focus {
                outline: none;
                border-color: var(--color-primary);
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
            .btn-small { font-size: 12px; padding: 4px 10px; }
            .btn-sm {
                padding: 4px 10px;
                font-size: 12px;
                height: 30px;
            }
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
            .entry-title { font-weight: 500; font-size: 14px; }
            .entry-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
            .alert { padding: 12px 16px; border-radius: var(--rounded-md); margin-bottom: 20px; font-size: 14px; }
            .alert-success { background: #dcfce7; color: #166534; }
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 36px; height: 36px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px; }
            .user-name { font-weight: 500; font-size: 14px; }
            .user-role { font-size: 12px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; width: 100%; text-align: left; }
            .logout-btn:hover { color: #dc2626; }
            @media (max-width: 768px) {
                .entry-grid { grid-template-columns: 1fr; }
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
                <a href="{{ route('applicant.dashboard') }}" class="nav-link">
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

            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Application: {{ $application->application_code }}</h1>
                    <p class="page-subtitle">{{ $application->job->plantillaPosition->position_name ?? '-' }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('applicant.update-application', $application->id) }}">
                @csrf
                @method('PUT')

                <!-- Education Section -->
                <div class="card">
                    <div class="card-title">
                        <span>Education</span>
                        <button type="button" class="btn-primary btn-small" onclick="addEducation()">+ Add Education</button>
                    </div>
                    <div id="education-entries">
                        @foreach($application->educations as $edu)
                        <div class="entry-row" data-id="{{ $edu->id }}">
                            <div class="entry-row-header">
                                <span class="entry-title">Education Entry</span>
                                <button type="button" class="btn-danger btn-small" onclick="deleteEntry('education', {{ $edu->id }})">Delete</button>
                            </div>
                            <input type="hidden" name="educations[{{ $loop->index }}][id]" value="{{ $edu->id }}">
                            <div class="entry-grid">
                                <div class="form-group">
                                    <label class="form-label">Level</label>
                                    <select name="educations[{{ $loop->index }}][level]" class="form-select">
                                        <option value="Elementary" {{ $edu->level == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                                        <option value="High School" {{ $edu->level == 'High School' ? 'selected' : '' }}>High School</option>
                                        <option value="Senior High School" {{ $edu->level == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                                        <option value="Bachelors" {{ $edu->level == 'Bachelors' ? 'selected' : '' }}>Bachelors</option>
                                        <option value="Masters" {{ $edu->level == 'Masters' ? 'selected' : '' }}>Masters</option>
                                        <option value="Doctorate" {{ $edu->level == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Year Graduated</label>
                                    <input type="number" name="educations[{{ $loop->index }}][year_graduated]" class="form-input" value="{{ $edu->year_graduated }}" min="1900" max="2099">
                                </div>
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">School Name</label>
                                    <input type="text" name="educations[{{ $loop->index }}][school_name]" class="form-input" value="{{ $edu->school_name }}" required>
                                </div>
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Course (Optional)</label>
                                    <input type="text" name="educations[{{ $loop->index }}][course]" class="form-input" value="{{ $edu->course }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="education-template" style="display: none;">
                        <div class="entry-row new-entry">
                            <div class="entry-row-header">
                                <span class="entry-title">New Education</span>
                                <button type="button" class="btn-danger btn-small" onclick="this.closest('.entry-row').remove()">Delete</button>
                            </div>
                            <div class="entry-grid">
                                <div class="form-group">
                                    <label class="form-label">Level</label>
                                    <select name="educations[__INDEX__][level]" class="form-select">
                                        <option value="Elementary">Elementary</option>
                                        <option value="High School">High School</option>
                                        <option value="Senior High School">Senior High School</option>
                                        <option value="Bachelors">Bachelors</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Doctorate">Doctorate</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Year Graduated</label>
                                    <input type="number" name="educations[__INDEX__][year_graduated]" class="form-input" min="1900" max="2099">
                                </div>
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">School Name</label>
                                    <input type="text" name="educations[__INDEX__][school_name]" class="form-input" required>
                                </div>
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Course (Optional)</label>
                                    <input type="text" name="educations[__INDEX__][course]" class="form-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Training Section -->
                <div class="card">
                    <div class="card-title">
                        <span>Training</span>
                        <button type="button" class="btn-primary btn-small" onclick="addTraining()">+ Add Training</button>
                    </div>
                    <div id="training-entries">
                        @foreach($application->trainings as $train)
                        <div class="entry-row" data-id="{{ $train->id }}">
                            <div class="entry-row-header">
                                <span class="entry-title">Training Entry</span>
                                <button type="button" class="btn-danger btn-small" onclick="deleteEntry('training', {{ $train->id }})">Delete</button>
                            </div>
                            <input type="hidden" name="trainings[{{ $loop->index }}][id]" value="{{ $train->id }}">
                            <div class="entry-grid">
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Training Title</label>
                                    <input type="text" name="trainings[{{ $loop->index }}][training_title]" class="form-input" value="{{ $train->training_title }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Training Hours</label>
                                    <input type="number" name="trainings[{{ $loop->index }}][training_hours]" class="form-input" value="{{ $train->training_hours }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Conducted</label>
                                    <input type="date" name="trainings[{{ $loop->index }}][date_conducted]" class="form-input" value="{{ $train->date_conducted?->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="training-template" style="display: none;">
                        <div class="entry-row new-entry">
                            <div class="entry-row-header">
                                <span class="entry-title">New Training</span>
                                <button type="button" class="btn-danger btn-small" onclick="this.closest('.entry-row').remove()">Delete</button>
                            </div>
                            <div class="entry-grid">
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label class="form-label">Training Title</label>
                                    <input type="text" name="trainings[__INDEX__][training_title]" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Training Hours</label>
                                    <input type="number" name="trainings[__INDEX__][training_hours]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Conducted</label>
                                    <input type="date" name="trainings[__INDEX__][date_conducted]" class="form-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="card">
                    <div class="card-title">
                        <span>Work Experience</span>
                        <button type="button" class="btn-primary btn-small" onclick="addExperience()">+ Add Experience</button>
                    </div>
                    <div id="experience-entries">
                        @foreach($application->experiences as $exp)
                        <div class="entry-row" data-id="{{ $exp->id }}">
                            <div class="entry-row-header">
                                <span class="entry-title">Experience Entry</span>
                                <button type="button" class="btn-danger btn-small" onclick="deleteEntry('experience', {{ $exp->id }})">Delete</button>
                            </div>
                            <input type="hidden" name="experiences[{{ $loop->index }}][id]" value="{{ $exp->id }}">
                            <div class="entry-grid">
                                <div class="form-group">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="experiences[{{ $loop->index }}][position]" class="form-input" value="{{ $exp->position }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Employer</label>
                                    <input type="text" name="experiences[{{ $loop->index }}][employer]" class="form-input" value="{{ $exp->employer }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="experiences[{{ $loop->index }}][start_date]" class="form-input" value="{{ $exp->start_date?->format('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="experiences[{{ $loop->index }}][end_date]" class="form-input" value="{{ $exp->end_date?->format('Y-m-d') }}" {{ $exp->is_present ? 'disabled' : '' }}>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <input type="checkbox" name="experiences[{{ $loop->index }}][is_present]" value="1" {{ $exp->is_present ? 'checked' : '' }} onchange="toggleEndDate(this)"> Currently Working
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sector</label>
                                    <select name="experiences[{{ $loop->index }}][sector]" class="form-select">
                                        <option value="">Select Sector</option>
                                        <option value="Government" {{ $exp->sector == 'Government' ? 'selected' : '' }}>Government</option>
                                        <option value="Private" {{ $exp->sector == 'Private' ? 'selected' : '' }}>Private</option>
                                        <option value="Academic" {{ $exp->sector == 'Academic' ? 'selected' : '' }}>Academic</option>
                                        <option value="NGO" {{ $exp->sector == 'NGO' ? 'selected' : '' }}>NGO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="experience-template" style="display: none;">
                        <div class="entry-row new-entry">
                            <div class="entry-row-header">
                                <span class="entry-title">New Experience</span>
                                <button type="button" class="btn-danger btn-small" onclick="this.closest('.entry-row').remove()">Delete</button>
                            </div>
                            <div class="entry-grid">
                                <div class="form-group">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="experiences[__INDEX__][position]" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Employer</label>
                                    <input type="text" name="experiences[__INDEX__][employer]" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="experiences[__INDEX__][start_date]" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="experiences[__INDEX__][end_date]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <input type="checkbox" name="experiences[__INDEX__][is_present]" value="1" onchange="toggleEndDate(this)"> Currently Working
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sector</label>
                                    <select name="experiences[__INDEX__][sector]" class="form-select">
                                        <option value="">Select Sector</option>
                                        <option value="Government">Government</option>
                                        <option value="Private">Private</option>
                                        <option value="Academic">Academic</option>
                                        <option value="NGO">NGO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eligibility Section -->
                <div class="card">
                    <div class="card-title">
                        <span>Eligibility</span>
                        <button type="button" class="btn-primary btn-small" onclick="addEligibility()">+ Add Eligibility</button>
                    </div>
                    <div id="eligibility-entries">
                        @foreach($application->eligibilities as $elig)
                        <div class="entry-row" data-id="{{ $elig->id }}">
                            <div class="entry-row-header">
                                <span class="entry-title">Eligibility Entry</span>
                                <button type="button" class="btn-danger btn-small" onclick="deleteEntry('eligibility', {{ $elig->id }})">Delete</button>
                            </div>
                            <input type="hidden" name="eligibilities[{{ $loop->index }}][id]" value="{{ $elig->id }}">
                            <div class="entry-grid">
                                <div class="form-group">
                                    <label class="form-label">Eligibility Type</label>
                                    <select name="eligibilities[{{ $loop->index }}][eligibility_type_id]" class="form-select">
                                        @foreach(App\Models\EligibilityType::where('is_active', true)->get() as $type)
                                        <option value="{{ $type->id }}" {{ $elig->eligibility_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">License Number (Optional)</label>
                                    <input type="text" name="eligibilities[{{ $loop->index }}][license_no]" class="form-input" value="{{ $elig->license_no }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Issued (Optional)</label>
                                    <input type="date" name="eligibilities[{{ $loop->index }}][date_issued]" class="form-input" value="{{ $elig->date_issued?->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="eligibility-template" style="display: none;">
                        <div class="entry-row new-entry">
                            <div class="entry-row-header">
                                <span class="entry-title">New Eligibility</span>
                                <button type="button" class="btn-danger btn-small" onclick="this.closest('.entry-row').remove()">Delete</button>
                            </div>
                            <div class="entry-grid">
                                <div class="form-group">
                                    <label class="form-label">Eligibility Type</label>
                                    <select name="eligibilities[__INDEX__][eligibility_type_id]" class="form-select">
                                        @foreach(App\Models\EligibilityType::where('is_active', true)->get() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">License Number (Optional)</label>
                                    <input type="text" name="eligibilities[__INDEX__][license_no]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Issued (Optional)</label>
                                    <input type="date" name="eligibilities[__INDEX__][date_issued]" class="form-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 40px;">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    <a href="{{ route('applicant.view-application', $application->id) }}" class="btn-secondary" style="margin-left: 12px;">Cancel</a>
                </div>
            </form>
        </main>

        <script>
            let eduCount = {{ $application->educations->count() }};
            let trainCount = {{ $application->trainings->count() }};
            let expCount = {{ $application->experiences->count() }};
            let eligCount = {{ $application->eligibilities->count() }};

            function addEducation() {
                const template = document.getElementById('education-template').innerHTML.replace(/__INDEX__/g, eduCount++);
                document.getElementById('education-entries').insertAdjacentHTML('beforeend', template);
            }

            function addTraining() {
                const template = document.getElementById('training-template').innerHTML.replace(/__INDEX__/g, trainCount++);
                document.getElementById('training-entries').insertAdjacentHTML('beforeend', template);
            }

            function addExperience() {
                const template = document.getElementById('experience-template').innerHTML.replace(/__INDEX__/g, expCount++);
                document.getElementById('experience-entries').insertAdjacentHTML('beforeend', template);
            }

            function addEligibility() {
                const template = document.getElementById('eligibility-template').innerHTML.replace(/__INDEX__/g, eligCount++);
                document.getElementById('eligibility-entries').insertAdjacentHTML('beforeend', template);
            }

            function toggleEndDate(checkbox) {
                const endDateInput = checkbox.closest('.entry-grid').querySelector('input[name*="end_date"]');
                endDateInput.disabled = checkbox.checked;
                if (checkbox.checked) {
                    endDateInput.value = '';
                }
            }

            async function deleteEntry(type, id) {
                if (!confirm('Are you sure you want to delete this entry?')) return;

                try {
                    const response = await fetch('{{ route("applicant.delete-entry", $application->id) }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ type: type, id: id })
                    });

                    const data = await response.json();
                    if (data.success) {
                        document.querySelector(`[data-id="${id}"]`).remove();
                    } else {
                        alert(data.error || 'Error deleting entry');
                    }
                } catch (error) {
                    alert('Error deleting entry');
                }
            }
        </script>
    </body>
</html>