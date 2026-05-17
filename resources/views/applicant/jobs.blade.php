<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>Job Openings - DEPED Region V Recruitment</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); margin-bottom: 20px; overflow: hidden; }
            .job-card { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px; }
            .job-info { flex: 1; }
            .job-title { font-size: 16px; font-weight: 600; margin-bottom: 4px; }
            .job-dept { font-size: 14px; color: var(--color-body); margin-bottom: 8px; }
            .job-meta { display: flex; gap: 20px; font-size: 13px; color: var(--color-muted); flex-wrap: wrap; }
            .job-meta span { display: flex; align-items: center; gap: 4px; }
            .posted-time { font-size: 12px; color: var(--color-muted); }
            .btn-primary {
                background: var(--color-primary);
                color: white;
                font-size: 14px;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
            }
            .btn-primary:hover { background: var(--color-primary-hover); }
            .btn-secondary {
                background: var(--color-surface-card);
                color: var(--color-body);
                font-size: 14px;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: var(--rounded-md);
                border: 1px solid var(--color-hairline-strong);
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
            }
            .btn-secondary:hover { background: var(--color-surface-strong); }
            .btn-disabled { background: var(--color-surface-strong); color: var(--color-muted); font-size: 14px; font-weight: 500; padding: 10px 20px; border-radius: var(--rounded-md); border: none; }
            .user-info { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--color-surface-strong); border-radius: var(--rounded-md); }
            .user-avatar { width: 40px; height: 40px; background: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px; }
            .user-name { font-weight: 500; }
            .user-role { font-size: 13px; color: var(--color-body); }
            .logout-btn { color: var(--color-body); text-decoration: none; font-size: 13px; display: block; margin-top: 16px; padding: 8px 12px; cursor: pointer; border: none; background: none; }
            .logout-btn:hover { color: #dc2626; }
            .confirm-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; padding: 20px; }
            .confirm-overlay.show { display: flex; }
            .confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 500px; width: 100%; max-height: 90vh; overflow-y: auto; }
            .confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
            .confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
            .confirm-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
            .confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
            .confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
            .confirm-btn-logout { background: #dc2626; color: white; }
            .alert { padding: 12px 16px; border-radius: var(--rounded-md); margin-bottom: 20px; font-size: 14px; }
            .alert-error { background: #fee2e2; color: #991b1b; }
            .job-detail-section { margin-bottom: 24px; }
            .job-detail-header { display: flex; align-items: flex-start; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid var(--color-hairline); margin-bottom: 20px; }
            .job-detail-icon { width: 56px; height: 56px; background: linear-gradient(135deg, var(--color-primary), #004494); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
            .job-detail-icon svg { width: 28px; height: 28px; color: white; }
            .job-detail-header-content { flex: 1; }
            .job-detail-title { font-size: 20px; font-weight: 600; margin-bottom: 4px; }
            .job-detail-dept { font-size: 14px; color: var(--color-body); }
            .job-detail-badges { display: flex; gap: 8px; margin-top: 8px; flex-wrap: wrap; }
            .detail-badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: var(--color-canvas-soft); border-radius: 20px; font-size: 12px; color: var(--color-body); }
            .detail-badge svg { width: 14px; height: 14px; }
            .detail-badge.salary { background: #dcfce7; color: #166534; font-weight: 500; }
            .detail-badge.applicants { background: #e0e7ff; color: #3730a3; font-weight: 500; }
            .job-detail-label { font-size: 11px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
            .job-detail-value { font-size: 14px; line-height: 1.5; }
            .job-detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
            .job-detail-full { grid-column: 1 / -1; }
            .job-detail-card { background: var(--color-canvas-soft); border-radius: 10px; padding: 16px; }
            .job-detail-card-title { font-size: 13px; font-weight: 600; color: var(--color-ink); margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
            .job-detail-card-title svg { width: 16px; height: 16px; color: var(--color-primary); }
            .qualification-item { padding: 10px 0; border-bottom: 1px solid var(--color-hairline); }
            .qualification-item:last-child { border-bottom: none; }
            .qualification-label { font-size: 12px; color: var(--color-muted); text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; }
            .qualification-value { font-size: 14px; color: var(--color-ink); }
            .pdf-link { display: inline-flex; align-items: center; gap: 8px; background: var(--color-primary); color: white; padding: 10px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; }
            .pdf-link:hover { background: var(--color-primary-hover); text-decoration: none; }
            .pdf-link svg { width: 18px; height: 18px; }
            .no-pdf { display: inline-flex; align-items: center; gap: 8px; background: var(--color-surface-strong); color: var(--color-body); padding: 10px 16px; border-radius: 8px; font-size: 14px; }
            .action-buttons { display: flex; gap: 8px; }
            .btn-view { background: var(--color-surface-strong); color: var(--color-ink); font-size: 13px; font-weight: 500; padding: 8px 14px; border-radius: var(--rounded-md); border: 1px solid var(--color-hairline-strong); cursor: pointer; }
            .btn-view:hover { background: var(--color-hairline); }
            .section-divider { border-top: 1px solid var(--color-hairline); margin: 20px 0; padding-top: 20px; }
            .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
            .modal-close-btn { background: none; border: none; font-size: 24px; color: var(--color-muted); cursor: pointer; padding: 4px; line-height: 1; }
            .modal-close-btn:hover { color: var(--color-ink); }
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
                <a href="{{ route('applicant.jobs') }}" class="nav-link active">
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
                <div>
                    <h1 class="page-title">Job Openings</h1>
                    <p class="page-subtitle">Browse and apply for available positions</p>
                </div>
                <div class="filters">
                    <select class="filter-select" id="departmentFilter" onchange="filterJobs()">
                        <option value="">All Departments</option>
                    </select>
                    <select class="filter-select" id="positionFilter" onchange="filterJobs()">
                        <option value="">All Positions</option>
                    </select>
                    <select class="filter-select" id="sortFilter" onchange="sortJobs()">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="deadline">Deadline (Soonest)</option>
                        <option value="deadline-late">Deadline (Latest)</option>
                        <option value="salary-high">Salary (High to Low)</option>
                        <option value="salary-low">Salary (Low to High)</option>
                    </select>
                </div>
            </div>

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <div id="jobsContainer">
                @foreach($jobPostings as $job)
                    <div class="card" data-job-id="{{ $job->id }}" data-department="{{ $job->plantillaPosition->department ?? '' }}" data-position="{{ $job->plantillaPosition->position_name ?? '' }}">
                        <div class="job-card">
                            <div class="job-info">
                                <div class="job-title">{{ $job->plantillaPosition->position_name ?? 'Position' }}</div>
                                <div class="job-dept">{{ $job->plantillaPosition->department ?? 'Department' }} | Item No: {{ $job->plantillaPosition->plantilla_item_no ?? '-' }}</div>
                                <div class="job-meta">
                                    <span>SG-{{ $job->plantillaPosition->salary_grade ?? '-' }}</span>
                                    <span>PHP {{ number_format($job->monthly_salary, 2) }}/month</span>
                                    <span>{{ $job->applications_count }} applicant{{ $job->applications_count != 1 ? 's' : '' }}</span>
                                    <span>Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>
                                    <span class="posted-time" data-posted="{{ ($job->posted_at ?? $job->created_at)->toIsoString() }}"></span>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" class="btn-view" onclick="viewJob({{ $job->id }})">View</button>
                                @if(in_array($job->id, $appliedJobIds))
                                    <span class="btn-disabled">Already Applied</span>
                                @else
                                    <a href="#" onclick="openApplyModal({{ $job->id }}); return false;" class="btn-primary">Apply Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($jobPostings->count() == 0)
                <div class="card" style="text-align: center; padding: 60px;">
                    <p style="color: var(--color-body);">No job openings available at the moment.</p>
                </div>
            @endif
        </main>

        <!-- Job Detail Modal -->
        <div class="confirm-overlay" id="jobDetailModal">
            <div class="confirm-box" style="max-width: 600px;">
                <div class="modal-header">
                    <h3 class="confirm-title" id="detailJobTitle">Job Details</h3>
                    <button type="button" class="modal-close-btn" onclick="closeJobDetail()">&times;</button>
                </div>
                <div id="detailJobContent"></div>
                <div class="confirm-buttons" style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--color-hairline);">
                    <button type="button" class="confirm-btn confirm-btn-cancel" onclick="closeJobDetail()">Close</button>
                    <button type="button" class="btn-primary" id="detailApplyBtn" onclick="applyFromDetail()">Apply Now</button>
                </div>
            </div>
        </div>

        <!-- Apply Modal -->
        <div class="confirm-overlay" id="applyModal">
            <div class="confirm-box" style="max-width: 950px; width: 95%;">
                <h3 class="confirm-title" id="applyModalTitle">Apply for Position</h3>
                <div id="applyModalContent" style="max-height: 75vh; overflow-y: auto;"></div>
                <div class="confirm-buttons">
                    <button type="button" class="confirm-btn confirm-btn-cancel" onclick="closeApplyModal()">Cancel</button>
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
                        <button type="submit" class="confirm-btn confirm-btn-logout">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            let jobData = @json($jobPostings);
            let appliedJobIds = @json($appliedJobIds);
            let currentApplyJobId = null;

            // Relative time function
            function getRelativeTime(dateStr) {
                if (!dateStr) return 'Recently';
                const date = new Date(dateStr);
                if (isNaN(date.getTime())) return 'Recently';
                const now = new Date();
                const diffMs = now - date;
                if (diffMs < 0) return 'Just now';
                const diffMins = Math.floor(diffMs / 60000);
                if (diffMins < 1) return 'Just now';
                if (diffMins < 60) return diffMins + ' min' + (diffMins !== 1 ? 's' : '') + ' ago';
                const diffHours = Math.floor(diffMins / 60);
                if (diffHours < 24) return diffHours + ' hour' + (diffHours !== 1 ? 's' : '') + ' ago';
                const diffDays = Math.floor(diffHours / 24);
                if (diffDays < 7) return diffDays + ' day' + (diffDays !== 1 ? 's' : '') + ' ago';
                const diffWeeks = Math.floor(diffDays / 7);
                if (diffWeeks < 4) return diffWeeks + ' week' + (diffWeeks !== 1 ? 's' : '') + ' ago';
                const diffMonths = Math.floor(diffDays / 30);
                if (diffMonths < 12) return diffMonths + ' month' + (diffMonths !== 1 ? 's' : '') + ' ago';
                const diffYears = Math.floor(diffDays / 365);
                return diffYears + ' year' + (diffYears !== 1 ? 's' : '') + ' ago';
            }

            // Populate filters
            const departments = [...new Set(jobData.map(j => j.plantilla_position?.department).filter(Boolean))];
            const deptSelect = document.getElementById('departmentFilter');
            departments.forEach(dept => {
                const opt = document.createElement('option');
                opt.value = dept;
                opt.textContent = dept;
                deptSelect.appendChild(opt);
            });

            const positions = [...new Set(jobData.map(j => j.plantilla_position?.position_name).filter(Boolean))];
            const posSelect = document.getElementById('positionFilter');
            positions.forEach(pos => {
                const opt = document.createElement('option');
                opt.value = pos;
                opt.textContent = pos;
                posSelect.appendChild(opt);
            });

            function filterJobs() {
                const deptFilter = document.getElementById('departmentFilter').value;
                const posFilter = document.getElementById('positionFilter').value;
                document.querySelectorAll('.card').forEach(card => {
                    const dept = card.dataset.department;
                    const pos = card.dataset.position;
                    const matchDept = !deptFilter || dept === deptFilter;
                    const matchPos = !posFilter || pos === posFilter;
                    card.style.display = (matchDept && matchPos) ? 'block' : 'none';
                });
            }

            function sortJobs() {
                const sortValue = document.getElementById('sortFilter').value;
                const container = document.getElementById('jobsContainer');
                const cards = Array.from(container.querySelectorAll('.card'));
                
                cards.sort((a, b) => {
                    const jobA = jobData.find(j => j.id === parseInt(a.dataset.jobId));
                    const jobB = jobData.find(j => j.id === parseInt(b.dataset.jobId));
                    
                    if (!jobA || !jobB) return 0;
                    
                    switch(sortValue) {
                        case 'oldest':
                            return new Date(jobA.posted_at || jobA.created_at) - new Date(jobB.posted_at || jobB.created_at);
                        case 'deadline':
                            return new Date(jobA.deadline) - new Date(jobB.deadline);
                        case 'deadline-late':
                            return new Date(jobB.deadline) - new Date(jobA.deadline);
                        case 'salary-high':
                            return jobB.monthly_salary - jobA.monthly_salary;
                        case 'salary-low':
                            return jobA.monthly_salary - jobB.monthly_salary;
                        default: // newest
                            return new Date(jobB.posted_at || jobB.created_at) - new Date(jobA.posted_at || jobA.created_at);
                    }
                });
                
                cards.forEach(card => container.appendChild(card));
            }

            function viewJob(id) {
                const job = jobData.find(j => j.id === id);
                if (!job) return;

                currentApplyJobId = id;

                const dept = job.plantilla_position?.department || '-';
                const pos = job.plantilla_position?.position_name || '-';
                const itemNo = job.plantilla_position?.plantilla_item_no || '-';
                const sg = job.plantilla_position?.salary_grade || '-';
                const salary = parseFloat(job.monthly_salary).toLocaleString('en-PH', {minimumFractionDigits: 2});
                const deadline = new Date(job.deadline).toLocaleDateString('en-PH', {year: 'numeric', month: 'long', day: 'numeric'});
                let postedDate = 'N/A';
                try {
                    const postedDateRaw = job.posted_at || job.created_at;
                    if (postedDateRaw) {
                        const dateObj = new Date(postedDateRaw);
                        if (!isNaN(dateObj.getTime())) {
                            postedDate = dateObj.toLocaleDateString('en-PH', {year: 'numeric', month: 'long', day: 'numeric'});
                        }
                    }
                } catch(e) {
                    postedDate = 'N/A';
                }
                const applicants = job.applications_count || 0;
                const alreadyApplied = appliedJobIds.includes(job.id);

                let pdfHtml = '';
                if (job.job_description_pdf) {
                    pdfHtml = `<a href="/storage/${job.job_description_pdf}" target="_blank" class="pdf-link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        View Job Description PDF
                    </a>`;
                } else {
                    pdfHtml = `<span class="no-pdf">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        No PDF attached
                    </span>`;
                }

                let qualHtml = '';
                if (job.required_education) qualHtml += `<div class="qualification-item"><div class="qualification-label">Education</div><div class="qualification-value">${job.required_education || ''}</div></div>`;
                if (job.required_training) qualHtml += `<div class="qualification-item"><div class="qualification-label">Training</div><div class="qualification-value">${job.required_training || ''}</div></div>`;
                if (job.required_experience) qualHtml += `<div class="qualification-item"><div class="qualification-label">Experience</div><div class="qualification-value">${job.required_experience || ''}</div></div>`;
                if (job.required_eligibility) qualHtml += `<div class="qualification-item"><div class="qualification-label">Eligibility</div><div class="qualification-value">${job.required_eligibility || ''}</div></div>`;

                let descHtml = job.description ? `<div class="job-detail-card"><div class="job-detail-card-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>Description</div><div class="job-detail-value">${job.description}</div></div>` : '';

                document.getElementById('detailJobContent').innerHTML = `
                    <div class="job-detail-header">
                        <div class="job-detail-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                        </div>
                        <div class="job-detail-header-content">
                            <div class="job-detail-title">${pos}</div>
                            <div class="job-detail-dept">${dept}</div>
                            <div class="job-detail-dept" style="font-size: 13px; color: var(--color-muted); margin-top: 4px;">Plantilla Item No: ${itemNo}</div>
                            <div class="job-detail-badges">
                                <span class="detail-badge applicants">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    ${applicants} applicant${applicants != 1 ? 's' : ''}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="job-detail-grid">
                        <div class="job-detail-card">
                            <div class="job-detail-card-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                Timeline
                            </div>
                            <div class="qualification-item" style="border: none; padding: 4px 0;">
                                <div class="qualification-label">Posted</div>
                                <div class="qualification-value">${getRelativeTime(job.posted_at || job.created_at)}</div>
                            </div>
                            <div class="qualification-item" style="border: none; padding: 4px 0;">
                                <div class="qualification-label">Deadline</div>
                                <div class="qualification-value">${deadline}</div>
                            </div>
                        </div>
                        
                        <div class="job-detail-card">
                            <div class="job-detail-card-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Position
                            </div>
                            <div class="qualification-item" style="border: none; padding: 4px 0;">
                                <div class="qualification-label">Salary Grade</div>
                                <div class="qualification-value">SG-${sg}</div>
                            </div>
                            <div class="qualification-item" style="border: none; padding: 4px 0;">
                                <div class="qualification-label">Monthly Salary</div>
                                <div class="qualification-value" style="color: #16a34a; font-weight: 600;">PHP ${salary}</div>
                            </div>
                        </div>
                        
                        ${descHtml ? `<div class="job-detail-full">${descHtml}</div>` : ''}
                        
                        ${qualHtml ? `<div class="job-detail-full"><div class="job-detail-card"><div class="job-detail-card-title"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>Qualification Standards</div>${qualHtml}</div></div>` : ''}
                        
                        <div class="job-detail-full">
                            <div class="job-detail-label">Job Description</div>
                            <div style="margin-top: 8px;">${pdfHtml}</div>
                        </div>
                    </div>
                `;

                const applyBtn = document.getElementById('detailApplyBtn');
                if (alreadyApplied) {
                    applyBtn.textContent = 'Already Applied';
                    applyBtn.disabled = true;
                    applyBtn.style.opacity = '0.5';
                    applyBtn.style.cursor = 'default';
                } else {
                    applyBtn.textContent = 'Apply Now';
                    applyBtn.disabled = false;
                    applyBtn.style.opacity = '1';
                    applyBtn.style.cursor = 'pointer';
                }

                document.getElementById('jobDetailModal').classList.add('show');
            }

            function closeJobDetail() {
                document.getElementById('jobDetailModal').classList.remove('show');
            }

            function applyFromDetail() {
                const btn = document.getElementById('detailApplyBtn');
                if (btn.disabled) return;
                closeJobDetail();
                openApplyModal(currentApplyJobId);
            }

            function openApplyModal(jobId) {
                currentApplyJobId = jobId;
                const job = jobData.find(j => j.id === jobId);
                if (!job) return;

                document.getElementById('applyModalTitle').textContent = 'Apply for ' + (job.plantilla_position?.position_name || 'Position');
                document.getElementById('applyModalContent').innerHTML = '<div style="text-align: center; padding: 40px;">Loading application form...</div>';
                document.getElementById('applyModal').classList.add('show');

                // Load application form content
                fetch('/applicant/jobs/' + jobId + '/apply-form')
                    .then(response => response.text())
                    .then(html => {
                        // Extract script content
                        const scriptMatch = html.match(/<script>([\s\S]*?)<\/script>/);
                        const scriptContent = scriptMatch ? scriptMatch[1] : '';
                        const htmlWithoutScript = html.replace(/<script>[\s\S]*?<\/script>/, '');
                        
                        document.getElementById('applyModalContent').innerHTML = htmlWithoutScript;
                        
                        // Execute the script
                        if (scriptContent) {
                            try {
                                eval(scriptContent);
                            } catch (e) {
                                console.error('Script error:', e);
                            }
                        }

                        // Calculate age on load if date exists
                        const dobInput = document.querySelector('#applyModalContent input[name="date_of_birth"]');
                        if (dobInput && dobInput.value) {
                            const birth = new Date(dobInput.value);
                            const today = new Date();
                            let age = today.getFullYear() - birth.getFullYear();
                            const monthDiff = today.getMonth() - birth.getMonth();
                            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                                age--;
                            }
                            if (age >= 0 && age <= 150) {
                                const ageDisplay = document.getElementById('age_display');
                                const ageHidden = document.getElementById('age');
                                if (ageDisplay) ageDisplay.value = age;
                                if (ageHidden) ageHidden.value = age;
                            }
                        }
                    })
                    .catch(err => {
                        document.getElementById('applyModalContent').innerHTML = '<div style="text-align: center; padding: 40px; color: red;">Error loading form</div>';
                    });
            }

            function closeApplyModal() {
                document.getElementById('applyModal').classList.remove('show');
                currentApplyJobId = null;
            }

            function showLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.add('show');
            }
            function hideLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.remove('show');
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeJobDetail();
                    closeApplyModal();
                    hideLogoutConfirm();
                }
            });

            // Close modal when clicking outside
            document.getElementById('jobDetailModal').addEventListener('click', function(e) {
                if (e.target === this) closeJobDetail();
            });
            document.getElementById('applyModal').addEventListener('click', function(e) {
                if (e.target === this) closeApplyModal();
            });

            // Update relative times - run immediately and then every minute
            function updateRelativeTimes() {
                document.querySelectorAll('.posted-time').forEach(function(el) {
                    const postedAt = el.dataset.posted;
                    if (postedAt) {
                        el.textContent = getRelativeTime(postedAt);
                    }
                });
            }
            updateRelativeTimes();
            setInterval(updateRelativeTimes, 60000);
        </script>
    </body>
</html>

<?php
function getPostedTime($postedAt, $createdAt = null) {
    // Use created_at as fallback if posted_at is empty
    $dateToCheck = $postedAt ?: $createdAt;
    
    if (empty($dateToCheck)) {
        return 'Recently';
    }
    try {
        $posted = \Carbon\Carbon::parse($dateToCheck);
        $now = \Carbon\Carbon::now();
        
        if ($now->lt($posted)) {
            return 'Just now';
        }
        
        $diffInSeconds = $now->diffInSeconds($posted);
        if ($diffInSeconds < 60) {
            return 'Just now';
        }
        
        $diffInMinutes = $now->diffInMinutes($posted);
        if ($diffInMinutes < 60) {
            return $diffInMinutes . ' min' . ($diffInMinutes != 1 ? 's' : '') . ' ago';
        }
        
        $diffInHours = $now->diffInHours($posted);
        if ($diffInHours < 24) {
            return $diffInHours . ' hour' . ($diffInHours != 1 ? 's' : '') . ' ago';
        }
        
        $diffInDays = $now->diffInDays($posted);
        if ($diffInDays < 7) {
            return $diffInDays . ' day' . ($diffInDays != 1 ? 's' : '') . ' ago';
        }
        
        if ($diffInDays < 30) {
            $weeks = floor($diffInDays / 7);
            return $weeks . ' week' . ($weeks != 1 ? 's' : '') . ' ago';
        }
        
        if ($diffInDays < 365) {
            $months = floor($diffInDays / 30);
            return $months . ' month' . ($months != 1 ? 's' : '') . ' ago';
        }
        
        $years = floor($diffInDays / 365);
        return $years . ' year' . ($years != 1 ? 's' : '') . ' ago';
        
    } catch (\Exception $e) {
        return 'Recently';
    }
}