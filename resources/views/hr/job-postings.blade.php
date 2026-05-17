<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>Job Postings - DEPED Region V Recruitment</title>
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
            .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
            .page-title { font-size: 24px; font-weight: 600; }
            .btn-primary {
                background: var(--color-primary);
                color: white;
                font-size: 14px;
                font-weight: 500;
                padding: 10px 18px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }
            .btn-primary:hover { background: var(--color-primary-hover); }
            .btn-secondary {
                background: var(--color-surface-card);
                color: var(--color-ink);
                font-size: 14px;
                font-weight: 500;
                padding: 8px 16px;
                border-radius: var(--rounded-md);
                border: 1px solid var(--color-hairline-strong);
                cursor: pointer;
            }
            .btn-secondary:hover { background: var(--color-surface-strong); }
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
            .search-bar { display: flex; gap: 12px; margin-bottom: 20px; }
            .search-input {
                flex: 1;
                height: 44px;
                padding: 0 16px;
                font-size: 14px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                background: var(--color-surface-card);
                color: var(--color-ink);
            }
            .search-input:focus { outline: none; border-color: var(--color-primary); border-width: 2px; padding: 0 15px; }
            .filter-tabs { display: flex; gap: 8px; margin-bottom: 20px; }
            .filter-tab {
                padding: 8px 16px;
                font-size: 14px;
                font-weight: 500;
                border: none;
                background: var(--color-surface-strong);
                color: var(--color-body);
                border-radius: var(--rounded-md);
                cursor: pointer;
            }
            .filter-tab.active { background: var(--color-primary); color: white; }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); }
            .card-header { padding: 16px 20px; border-bottom: 1px solid var(--color-hairline); }
            .card-title { font-size: 16px; font-weight: 600; }
            .data-table { width: 100%; border-collapse: collapse; }
            .data-table th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--color-hairline); background: var(--color-canvas-soft); }
            .data-table td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--color-hairline); }
            .data-table tr:last-child td { border-bottom: none; }
            .data-table tr:hover td { background: var(--color-canvas-soft); }
            .badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
            .badge-open { background: #dcfce7; color: #166534; }
            .badge-draft { background: #f3f4f6; color: #6b7280; }
            .badge-closed { background: #fee2e2; color: #991b1b; }
            .action-buttons { display: flex; gap: 8px; }
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 36px; height: 36px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 13px; }
            .user-name { font-weight: 500; font-size: 14px; }
            .user-role { font-size: 12px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; width: 100%; text-align: left; }
            .logout-btn:hover { color: #dc2626; }
            .modal-overlay {
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
            .modal-overlay.show { display: flex; }
            .modal-box {
                background: white;
                border-radius: var(--rounded-lg);
                width: 100%;
                max-width: 700px;
                max-height: 90vh;
                overflow-y: auto;
            }
            .modal-header { padding: 20px 24px; border-bottom: 1px solid var(--color-hairline); display: flex; justify-content: space-between; align-items: center; }
            .modal-title { font-size: 18px; font-weight: 600; }
            .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: var(--color-muted); }
            .modal-body { padding: 24px; }
            .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
            .form-group { margin-bottom: 16px; }
            .form-label { display: block; font-size: 14px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px; }
            .form-label .required { color: #dc2626; }
            .form-input, .form-select, .form-textarea {
                width: 100%;
                height: 44px;
                padding: 0 16px;
                font-size: 14px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                background: var(--color-surface-card);
                color: var(--color-ink);
                font-family: var(--font-sans);
            }
            .form-textarea { height: auto; min-height: 80px; padding: 12px 16px; resize: vertical; }
            .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--color-primary); border-width: 2px; padding: 0 15px; }
            .form-input:disabled, .form-select:disabled { background: var(--color-canvas-soft); color: var(--color-muted); }
            .form-section-title { font-size: 14px; font-weight: 600; color: var(--color-body); margin: 24px 0 12px; padding-bottom: 8px; border-bottom: 1px solid var(--color-hairline); }
            .checkbox-group { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .checkbox-item { display: flex; align-items: center; gap: 8px; }
            .checkbox-item input { width: 16px; height: 16px; accent-color: var(--color-primary); }
            .checkbox-item label { font-size: 14px; color: var(--color-body); }
            .modal-footer { padding: 16px 24px; border-top: 1px solid var(--color-hairline); display: flex; justify-content: flex-end; gap: 12px; }
            .file-input-wrapper { position: relative; }
            .file-input-wrapper input[type="file"] { position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; }
            .file-input-display { display: flex; align-items: center; gap: 10px; padding: 10px 16px; border: 1px dashed var(--color-hairline-strong); border-radius: var(--rounded-md); background: var(--color-canvas-soft); font-size: 14px; color: var(--color-body); }
            .file-input-display.has-file { border-style: solid; background: var(--color-surface-card); }
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
                z-index: 1100;
            }
            .confirm-overlay.show { display: flex; }
            .confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 400px; text-align: center; }
            .confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
            .confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
            .confirm-buttons { display: flex; gap: 12px; justify-content: center; }
            .confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
            .confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
            .confirm-btn-delete { background: #dc2626; color: white; }
            .toast {
                position: fixed;
                bottom: 24px;
                right: 24px;
                background: var(--color-ink);
                color: white;
                padding: 12px 20px;
                border-radius: var(--rounded-md);
                font-size: 14px;
                display: none;
                z-index: 1200;
            }
            .toast.show { display: block; }
            @media (max-width: 768px) {
                .sidebar { width: 64px; padding: 24px 8px; }
                .sidebar .logo-text, .sidebar .nav-link span, .sidebar .nav-section, .sidebar .user-info, .sidebar .logout-btn { display: none; }
                .main-content { margin-left: 64px; padding: 16px; }
                .form-row { grid-template-columns: 1fr; }
                .data-table { font-size: 13px; }
                .data-table th, .data-table td { padding: 10px 8px; }
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
                <h1 class="page-title">Job Postings</h1>
                <button type="button" class="btn-primary" onclick="openModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Create New Job
                </button>
            </div>

            <div class="search-bar">
                <input type="text" class="search-input" id="searchInput" placeholder="Search by position, department..." onkeyup="filterTable()">
            </div>

            <div class="filter-tabs">
                <button type="button" class="filter-tab active" onclick="filterStatus('all')">All</button>
                <button type="button" class="filter-tab" onclick="filterStatus('draft')">Draft</button>
                <button type="button" class="filter-tab" onclick="filterStatus('open')">Open</button>
                <button type="button" class="filter-tab" onclick="filterStatus('closed')">Closed</button>
            </div>

            <div class="card">
                <table class="data-table" id="jobTable">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Salary Grade</th>
                            <th>Monthly Salary</th>
                            <th>Status</th>
                            <th>Deadline</th>
                            <th>Applications</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobPostings as $job)
                        <tr data-status="{{ $job->status }}">
                            <td><strong>{{ $job->plantillaPosition->position_name ?? 'N/A' }}</strong></td>
                            <td>{{ $job->plantillaPosition->department ?? 'N/A' }}</td>
                            <td>SG-{{ $job->plantillaPosition->salary_grade ?? '-' }}</td>
                            <td>PHP {{ number_format($job->monthly_salary, 2) }}</td>
                            <td><span class="badge badge-{{ $job->status }}">{{ ucfirst($job->status) }}</span></td>
                            <td>{{ $job->deadline->format('M d, Y') }}</td>
                            <td>{{ $job->applications->count() }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="btn-secondary" onclick="editJob({{ $job->id }})">Edit</button>
                                    <button type="button" class="btn-danger" onclick="confirmDelete({{ $job->id }})">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--color-muted); padding: 40px;">No job postings found. Create your first job posting!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Create/Edit Modal -->
        <div class="modal-overlay" id="jobModal">
            <div class="modal-box">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalTitle">Create New Job Posting</h2>
                    <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form method="POST" id="jobForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="id" id="jobId" value="">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Department <span class="required">*</span></label>
                                <select class="form-select" id="departmentSelect" name="department" onchange="loadPositions()">
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Plantilla Position <span class="required">*</span></label>
                                <select class="form-select" id="positionSelect" name="plantilla_position_id" onchange="loadPositionDetails()" required>
                                    <option value="">Select Position</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Position Name</label>
                                <input type="text" class="form-input" id="positionName" disabled>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Position Code</label>
                                <input type="text" class="form-input" id="positionCode" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Salary Grade</label>
                                <input type="text" class="form-input" id="salaryGrade" disabled>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Monthly Salary <span class="required">*</span></label>
                                <input type="number" class="form-input" name="monthly_salary" id="monthlySalary" required min="0" step="0.01">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-textarea" name="description" id="jobDescription" rows="3" placeholder="Enter job description..."></textarea>
                        </div>

                        <div class="form-section-title">Qualification Standards</div>

                        <div class="form-group">
                            <label class="form-label">Required Education</label>
                            <input type="text" class="form-input" name="required_education" id="requiredEducation" placeholder="e.g., Bachelor's Degree in Education">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Required Training</label>
                            <input type="text" class="form-input" name="required_training" id="requiredTraining" placeholder="e.g., 40 hours of relevant training">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Required Experience</label>
                            <input type="text" class="form-input" name="required_experience" id="requiredExperience" placeholder="e.g., 2 years of teaching experience">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Required Eligibility</label>
                            <input type="text" class="form-input" name="required_eligibility" id="requiredEligibility" placeholder="e.g., RA 1080 (LET)">
                        </div>

                        <div class="form-section-title">Requirements (Documents Required from Applicants)</div>
                        <div class="checkbox-group" id="requirementsCheckboxes">
                            <!-- Loaded via AJAX -->
                        </div>

                        <div class="form-section-title">Other Details</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Deadline <span class="required">*</span></label>
                                <input type="datetime-local" class="form-input" name="deadline" id="deadline" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status <span class="required">*</span></label>
                                <select class="form-select" name="status" id="jobStatus" required>
                                    <option value="draft">Draft</option>
                                    <option value="open" selected>Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Job Description PDF (Max 20MB, PDF only)</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="job_description_pdf" id="jobDescriptionPdf" accept=".pdf" onchange="updateFileDisplay(this)">
                                <div class="file-input-display" id="fileDisplay">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                    <span>Click to upload PDF or drag and drop</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn-primary">Save Job Posting</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation -->
        <div class="confirm-overlay" id="deleteConfirm">
            <div class="confirm-box">
                <h3 class="confirm-title">Delete Job Posting</h3>
                <p class="confirm-message">Are you sure you want to delete this job posting? This action cannot be undone.</p>
                <div class="confirm-buttons">
                    <button type="button" class="confirm-btn confirm-btn-cancel" onclick="hideDeleteConfirm()">Cancel</button>
                    <form method="POST" id="deleteForm" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="confirm-btn confirm-btn-delete">Delete</button>
                    </form>
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
                        <button type="submit" class="confirm-btn confirm-btn-delete">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Toast -->
        <div class="toast" id="toast"></div>

        <script>
            let currentFilter = 'all';
            let jobData = {!! $jobPostings->toJson() !!};

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                loadDepartments();
                loadDocumentTypes();
            });

            function loadDepartments() {
                return fetch('{{ route("hr.job-postings.departments") }}')
                    .then(response => response.json())
                    .then(data => {
                        const select = document.getElementById('departmentSelect');
                        data.forEach(dept => {
                            const option = document.createElement('option');
                            option.value = dept;
                            option.textContent = dept;
                            select.appendChild(option);
                        });
                    });
            }

            function loadPositions() {
                const department = document.getElementById('departmentSelect').value;
                const positionSelect = document.getElementById('positionSelect');
                positionSelect.innerHTML = '<option value="">Select Position</option>';

                if (!department) return;

                fetch('{{ route("hr.job-postings.positions") }}?department=' + encodeURIComponent(department))
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(pos => {
                            const option = document.createElement('option');
                            option.value = pos.id;
                            option.textContent = pos.position_name;
                            option.dataset.code = pos.position_code;
                            option.dataset.grade = pos.salary_grade;
                            positionSelect.appendChild(option);
                        });
                    });
            }

            function loadPositionDetails() {
                const positionId = document.getElementById('positionSelect').value;
                const selectedOption = document.getElementById('positionSelect').selectedOptions[0];

                if (positionId) {
                    document.getElementById('positionName').value = selectedOption.textContent;
                    document.getElementById('positionCode').value = selectedOption.dataset.code || '';
                    document.getElementById('salaryGrade').value = 'SG-' + (selectedOption.dataset.grade || '');
                } else {
                    document.getElementById('positionName').value = '';
                    document.getElementById('positionCode').value = '';
                    document.getElementById('salaryGrade').value = '';
                }
            }

            function loadDocumentTypes(preselectedIds = []) {
                fetch('{{ route("hr.job-postings.document-types") }}')
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('requirementsCheckboxes');
                        container.innerHTML = '';
                        data.forEach(doc => {
                            const isChecked = preselectedIds.map(String).includes(String(doc.id));
                            const item = document.createElement('div');
                            item.className = 'checkbox-item';
                            item.innerHTML = `
                                <input type="checkbox" id="doc_${doc.id}" name="requirements[]" value="${doc.id}" ${isChecked ? 'checked' : ''}>
                                <label for="doc_${doc.id}">${doc.name}${doc.is_required ? ' *' : ''}</label>
                            `;
                            container.appendChild(item);
                        });
                    });
            }

            function openModal() {
                document.getElementById('modalTitle').textContent = 'Create New Job Posting';
                document.getElementById('formMethod').value = 'POST';
                document.getElementById('jobForm').action = '{{ route("hr.job-postings") }}';
                document.getElementById('jobId').value = '';
                document.getElementById('jobForm').reset();
                document.getElementById('fileDisplay').innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg><span>Click to upload PDF or drag and drop</span>';
                loadDepartments();
                loadDocumentTypes([]); // Empty for create mode
                document.getElementById('jobModal').classList.add('show');
            }

            function closeModal() {
                document.getElementById('jobModal').classList.remove('show');
            }

            function editJob(id) {
                console.log('editJob called with id:', id);
                const job = jobData.find(j => j.id === id);
                if (!job) {
                    console.log('Job not found');
                    return;
                }
                console.log('Job requirements:', job.requirements);

                document.getElementById('modalTitle').textContent = 'Edit Job Posting';
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('jobForm').action = '/hr/job-postings/' + id;
                document.getElementById('jobId').value = id;

                // Set department first
                loadDepartments().then(() => {
                    document.getElementById('departmentSelect').value = job.plantilla_position?.department;
                    return fetch('{{ route("hr.job-postings.positions") }}?department=' + encodeURIComponent(job.plantilla_position?.department || ''));
                }).then(response => response.json()).then(positions => {
                    const positionSelect = document.getElementById('positionSelect');
                    positionSelect.innerHTML = '<option value="">Select Position</option>';
                    positions.forEach(pos => {
                        const option = document.createElement('option');
                        option.value = pos.id;
                        option.textContent = pos.position_name;
                        option.dataset.code = pos.position_code;
                        option.dataset.grade = pos.salary_grade;
                        if (pos.id === job.plantilla_position_id) option.selected = true;
                        positionSelect.appendChild(option);
                    });
                    loadPositionDetails();
                });

                document.getElementById('monthlySalary').value = job.monthly_salary;
                document.getElementById('jobDescription').value = job.description || '';
                document.getElementById('requiredEducation').value = job.required_education || '';
                document.getElementById('requiredTraining').value = job.required_training || '';
                document.getElementById('requiredExperience').value = job.required_experience || '';
                document.getElementById('requiredEligibility').value = job.required_eligibility || '';
                document.getElementById('deadline').value = job.deadline ? job.deadline.slice(0, 16) : '';
                document.getElementById('jobStatus').value = job.status;

                // Check requirements - load document types with preselected IDs
                const requirements = job.requirements || [];
                console.log('Loading requirements:', requirements);
                loadDocumentTypes(requirements);

                document.getElementById('jobModal').classList.add('show');
            }

            function confirmDelete(id) {
                document.getElementById('deleteForm').action = '/hr/job-postings/' + id;
                document.getElementById('deleteConfirm').classList.add('show');
            }

            function hideDeleteConfirm() {
                document.getElementById('deleteConfirm').classList.remove('show');
            }

            function showLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.add('show');
            }

            function hideLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.remove('show');
            }

            function updateFileDisplay(input) {
                const display = document.getElementById('fileDisplay');
                if (input.files && input.files[0]) {
                    display.classList.add('has-file');
                    display.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg><span>' + input.files[0].name + '</span>';
                }
            }

            function filterTable() {
                const search = document.getElementById('searchInput').value.toLowerCase();
                const rows = document.querySelectorAll('#jobTable tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            }

            function filterStatus(status) {
                currentFilter = status;
                document.querySelectorAll('.filter-tab').forEach(tab => tab.classList.remove('active'));
                event.target.classList.add('active');

                const rows = document.querySelectorAll('#jobTable tbody tr');
                rows.forEach(row => {
                    if (status === 'all') {
                        row.style.display = '';
                    } else {
                        row.style.display = row.dataset.status === status ? '' : 'none';
                    }
                });
            }

            // Show toast messages
            @if(session('success'))
            showToast('{{ session("success") }}');
            @endif
            @if($errors->any())
            showToast('{{ $errors->first() }}', true);
            @endif

            function showToast(message, isError = false) {
                const toast = document.getElementById('toast');
                toast.textContent = message;
                toast.style.background = isError ? '#dc2626' : '#171717';
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3000);
            }
        </script>
    </body>
</html>