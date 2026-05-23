<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="DEPED Region V - Online Recruitment and Selection Management System">
        <title>DEPED Region V - Recruitment Management System</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <style>
            :root {
                --color-primary: #0057B8;
                --color-primary-active: #004494;
                --color-text-link: #0057B8;
                --color-text-link-secondary: #004494;
                --color-ink: #171717;
                --color-body: #60646c;
                --color-muted: #999999;
                --color-hairline: #f0f0f3;
                --color-hairline-strong: #dcdee0;
                --color-canvas: #ffffff;
                --color-canvas-soft: #fafafa;
                --color-surface-card: #ffffff;
                --color-surface-strong: #f0f0f3;
                --color-surface-dark: #171717;
                --color-on-primary: #ffffff;
                --color-on-dark: #ffffff;
                --color-on-dark-soft: #b0b4ba;
                --color-gradient-sky-light: #e6f0fa;
                --color-gradient-sky-mid: #cce0f5;
                --color-semantic-success: #16a34a;
                --color-accent-warning: #ab6400;

                --font-sans: 'Inter', -apple-system, system-ui, sans-serif;
                --font-mono: 'JetBrains Mono', 'Fira Code', monospace;

                --rounded-md: 8px;
                --rounded-lg: 12px;
                --rounded-xl: 16px;

                --spacing-xs: 8px;
                --spacing-sm: 12px;
                --spacing-base: 16px;
                --spacing-md: 20px;
                --spacing-lg: 24px;
                --spacing-xl: 32px;
                --spacing-xxl: 48px;
                --spacing-section: 96px;

                --shadow-soft: 0 4px 12px rgba(0, 0, 0, 0.04);
            }

            * { margin: 0; padding: 0; box-sizing: border-box; }

            body {
                font-family: var(--font-sans);
                background-color: var(--color-canvas);
                color: var(--color-ink);
                line-height: 1.5;
            }

            .font-display-mega { font-size: 64px; font-weight: 600; line-height: 1.05; letter-spacing: -1.92px; }
            .font-display-lg { font-size: 36px; font-weight: 600; line-height: 1.15; letter-spacing: -1.08px; }
            .font-display-md { font-size: 28px; font-weight: 600; line-height: 1.2; letter-spacing: -0.84px; }
            .font-title-md { font-size: 18px; font-weight: 600; line-height: 1.4; }
            .font-title-sm { font-size: 16px; font-weight: 600; line-height: 1.4; }
            .font-body-md { font-size: 16px; font-weight: 400; line-height: 1.5; }
            .font-body-sm { font-size: 14px; font-weight: 400; line-height: 1.5; }
            .font-caption { font-size: 13px; font-weight: 400; line-height: 1.4; }
            .font-button { font-size: 14px; font-weight: 500; line-height: 1.0; }
            .font-nav-link { font-size: 14px; font-weight: 500; line-height: 1.4; }

            .btn-primary {
                background-color: var(--color-primary);
                color: var(--color-on-primary);
                font: var(--font-button);
                padding: 10px 18px;
                border-radius: var(--rounded-md);
                height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                border: none;
                cursor: pointer;
            }
            .btn-primary:hover { background-color: #004494; }

            .btn-secondary {
                background-color: var(--color-surface-card);
                color: var(--color-ink);
                font: var(--font-button);
                padding: 9px 17px;
                border-radius: var(--rounded-md);
                height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                border: 1px solid var(--color-hairline-strong);
                cursor: pointer;
            }
            .btn-secondary:hover { background-color: var(--color-surface-strong); }

            .text-link { color: var(--color-text-link); text-decoration: none; }
            .text-link:hover { text-decoration: underline; }
            .text-muted { color: var(--color-muted); }
            .text-body { color: var(--color-body); }

            .container { max-width: 1200px; margin: 0 auto; padding: 0 var(--spacing-lg); }

            .hero-gradient {
                background: radial-gradient(ellipse 80% 50% at 50% 0%, #0057B8 0%, #004494 40%, transparent 70%);
            }

            .badge-pill {
                background: var(--color-surface-strong);
                color: var(--color-ink);
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.88px;
                border-radius: 9999px;
                padding: 4px 10px;
            }

            .job-card {
                background: var(--color-surface-card);
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-lg);
                padding: var(--spacing-lg);
                transition: box-shadow 0.2s ease;
            }
            .job-card:hover { box-shadow: var(--shadow-soft); }

            .search-input {
                background: var(--color-surface-card);
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                padding: 12px 16px;
                font-size: 16px;
                width: 100%;
                height: 44px;
            }
            .search-input:focus {
                outline: none;
                border-color: var(--color-ink);
                border-width: 2px;
            }

            .dept-tag {
                font-size: 12px;
                color: var(--color-body);
                background: var(--color-surface-strong);
                padding: 2px 8px;
                border-radius: 4px;
            }

            .badge-open {
                background: #16a34a;
                color: #fff;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.88px;
                border-radius: 9999px;
                padding: 4px 10px;
            }

            .modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                justify-content: center;
                align-items: center;
                overflow-y: auto;
                padding: var(--spacing-lg);
            }
            .modal-overlay.open { display: flex; }
            .modal-content {
                background: var(--color-canvas);
                border-radius: var(--rounded-xl);
                max-width: 640px;
                width: 100%;
                padding: var(--spacing-xl);
                position: relative;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            }
            .modal-close {
                position: absolute;
                top: var(--spacing-base);
                right: var(--spacing-base);
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                color: var(--color-muted);
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
            }
            .modal-close:hover { background: var(--color-surface-strong); color: var(--color-ink); }
            body.modal-open { overflow: hidden; }
            .modal-divider {
                height: 1px;
                background: var(--color-hairline-strong);
                margin: var(--spacing-base) 0;
            }

            @media (max-width: 640px) {
                .font-display-mega { font-size: 32px; letter-spacing: -0.5px; }
                .font-display-lg { font-size: 24px; letter-spacing: -0.5px; }
                .container { padding: 0 var(--spacing-base); }
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header style="background: var(--color-canvas); border-bottom: 1px solid var(--color-hairline);">
            <div class="container" style="height: 64px; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0057B8" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                    <div>
                        <div style="font-weight: 600; font-size: 18px; color: var(--color-ink);">DEPED Region V</div>
                        <div style="font-size: 12px; color: var(--color-muted);">Recruitment Management System</div>
                    </div>
                </div>
                <nav style="display: flex; align-items: center; gap: var(--spacing-base);">
                    <a href="#jobs" class="font-nav-link" style="color: var(--color-ink); text-decoration: none;">Job Openings</a>
                    <a href="#" class="font-nav-link" style="color: var(--color-ink); text-decoration: none;">About</a>
                    <a href="#" class="font-nav-link" style="color: var(--color-ink); text-decoration: none;">FAQs</a>
                    <a href="{{ route('login') }}" class="font-nav-link" style="color: var(--color-ink); text-decoration: none;">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-primary">Apply Now</a>
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-gradient" style="padding: var(--spacing-section) 0;">
            <div class="container" style="text-align: center;">
                <span class="badge-pill" style="margin-bottom: var(--spacing-base); display: inline-block;">Online Recruitment System</span>
                <h1 class="font-display-mega" style="color: var(--color-ink); max-width: 800px; margin: 0 auto var(--spacing-lg);">
                    Join the Department of Education Region V
                </h1>
                <p class="font-body-md text-body" style="max-width: 600px; margin: 0 auto var(--spacing-xl);">
                    Find your next opportunity in education. Browse available positions, track your applications, and manage your career journey with us.
                </p>
                <div style="display: flex; gap: var(--spacing-sm); justify-content: center;">
                    <a href="#jobs" class="btn-primary">View Open Positions</a>
                    <a href="#" class="btn-secondary">How to Apply</a>
                </div>
            </div>
        </section>

        <!-- Job Search Section -->
        <section id="jobs" style="padding: var(--spacing-section) 0; background: var(--color-canvas);">
            <div class="container">
                <h2 class="font-display-lg" style="margin-bottom: var(--spacing-lg);">Available Positions</h2>

                <!-- Search Bar -->
                <div style="display: flex; gap: var(--spacing-sm); margin-bottom: var(--spacing-xl); max-width: 600px;">
                    <input type="text" class="search-input" placeholder="Search by position, department, or keywords...">
                    <button class="btn-primary">Search</button>
                </div>

                <!-- Job Listings -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--spacing-lg);">
                    @forelse ($jobPostings as $job)
                        <div class="job-card">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                                <div>
                                    <h3 class="font-title-md" style="margin-bottom: 4px;">{{ $job->plantillaPosition->position_name }}</h3>
                                    <span class="dept-tag">{{ $job->plantillaPosition->department }}</span>
                                </div>
                                <span class="badge-open">Open</span>
                            </div>
                            <p class="font-body-sm text-body" style="margin-bottom: var(--spacing-base);">{{ $job->description }}</p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; flex-direction: column; gap: 2px;">
                                    <span class="font-caption text-muted">Salary Grade {{ $job->plantillaPosition->salary_grade }}</span>
                                    <span class="font-caption text-muted">Posted {{ $job->posted_at?->format('M d, Y') ?? 'N/A' }}</span>
                                    <span class="font-caption text-muted">{{ $job->applications_count > 0 ? $job->applications_count . ' applicant' . ($job->applications_count > 1 ? 's' : '') : 'No applicants yet' }} &middot; Deadline: {{ $job->deadline->format('M d, Y') }}</span>
                                </div>
                                <button onclick="openJobModal({{ $job->id }})" class="btn-secondary" style="padding: 8px 16px; height: 36px; font-size: 13px; align-self: end;">View Details</button>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: var(--spacing-xxl) 0;">
                            <p class="font-body-md text-muted">No open positions at the moment. Please check back later.</p>
                        </div>
                    @endforelse
                </div>

                @if ($allJobPostings->isNotEmpty())
                    <div style="text-align: center; margin-top: var(--spacing-xl);">
                        <button onclick="openViewAllModal()" class="text-link font-body-md" style="background: none; border: none; cursor: pointer; font-family: inherit;">View all open positions &rarr;</button>
                    </div>
                @endif
            </div>
        </section>

        <!-- How It Works -->
        <section style="padding: var(--spacing-section) 0; background: var(--color-canvas-soft);">
            <div class="container">
                <h2 class="font-display-lg" style="text-align: center; margin-bottom: var(--spacing-xxl);">How to Apply</h2>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--spacing-lg);">
                    <div style="text-align: center;">
                        <div style="width: 48px; height: 48px; background: var(--color-surface-strong); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-base); font-weight: 600; font-size: 18px;">1</div>
                        <h3 class="font-title-sm" style="margin-bottom: var(--spacing-xs);">Create Account</h3>
                        <p class="font-body-sm text-body">Register with your email and basic information</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 48px; height: 48px; background: var(--color-surface-strong); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-base); font-weight: 600; font-size: 18px;">2</div>
                        <h3 class="font-title-sm" style="margin-bottom: var(--spacing-xs);">Complete Profile</h3>
                        <p class="font-body-sm text-body">Fill in your personal information and qualifications</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 48px; height: 48px; background: var(--color-surface-strong); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-base); font-weight: 600; font-size: 18px;">3</div>
                        <h3 class="font-title-sm" style="margin-bottom: var(--spacing-xs);">Submit Application</h3>
                        <p class="font-body-sm text-body">Apply to positions with required documents</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 48px; height: 48px; background: var(--color-surface-strong); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-base); font-weight: 600; font-size: 18px;">4</div>
                        <h3 class="font-title-sm" style="margin-bottom: var(--spacing-xs);">Track Status</h3>
                        <p class="font-body-sm text-body">Monitor your application status online</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section style="padding: var(--spacing-section) 0; background: var(--color-canvas);">
            <div class="container" style="max-width: 720px;">
                <h2 class="font-display-lg" style="text-align: center; margin-bottom: var(--spacing-xxl);">Frequently Asked Questions</h2>
                <div style="display: flex; flex-direction: column; gap: var(--spacing-sm);">
                    <!-- Q1 -->
                    <div class="faq-item" style="border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-lg); overflow: hidden;">
                        <button onclick="this.parentElement.classList.toggle('open')" style="width: 100%; background: none; border: none; padding: var(--spacing-lg); text-align: left; font: inherit; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <span class="font-title-sm">How do I create an account?</span>
                            <span class="faq-icon" style="font-size: 20px; transition: transform 0.2s;">+</span>
                        </button>
                        <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease; padding: 0 var(--spacing-lg);">
                            <p class="font-body-sm text-body" style="padding-bottom: var(--spacing-lg);">Click the "Apply Now" button on the top right or the "Create Account" button below. Fill in your email address, full name, and create a password. After registration, you can complete your profile with your personal information, education, training, and work experience.</p>
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="faq-item" style="border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-lg); overflow: hidden;">
                        <button onclick="this.parentElement.classList.toggle('open')" style="width: 100%; background: none; border: none; padding: var(--spacing-lg); text-align: left; font: inherit; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <span class="font-title-sm">How do I apply for a job?</span>
                            <span class="faq-icon" style="font-size: 20px; transition: transform 0.2s;">+</span>
                        </button>
                        <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease; padding: 0 var(--spacing-lg);">
                            <p class="font-body-sm text-body" style="padding-bottom: var(--spacing-lg);">Once your profile is complete, browse the Available Positions section on this page. Click "View Details" on a position you're interested in, then click "Apply" to submit your application. You can track all your applications on your applicant dashboard after logging in.</p>
                        </div>
                    </div>
                    <!-- Q3 -->
                    <div class="faq-item" style="border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-lg); overflow: hidden;">
                        <button onclick="this.parentElement.classList.toggle('open')" style="width: 100%; background: none; border: none; padding: var(--spacing-lg); text-align: left; font: inherit; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <span class="font-title-sm">What documents do I need to submit?</span>
                            <span class="faq-icon" style="font-size: 20px; transition: transform 0.2s;">+</span>
                        </button>
                        <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease; padding: 0 var(--spacing-lg);">
                            <p class="font-body-sm text-body" style="padding-bottom: var(--spacing-lg);">You will need your Diploma, Transcript of Records (TOR), Certificate of Employment (COE), eligibility (if applicable), and other relevant training certificates. Upload these documents in your profile before applying to a position.</p>
                        </div>
                    </div>
                    <!-- Q4 -->
                    <div class="faq-item" style="border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-lg); overflow: hidden;">
                        <button onclick="this.parentElement.classList.toggle('open')" style="width: 100%; background: none; border: none; padding: var(--spacing-lg); text-align: left; font: inherit; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <span class="font-title-sm">How are applications evaluated?</span>
                            <span class="faq-icon" style="font-size: 20px; transition: transform 0.2s;">+</span>
                        </button>
                        <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease; padding: 0 var(--spacing-lg);">
                            <p class="font-body-sm text-body" style="padding-bottom: var(--spacing-lg);">Each application is reviewed by sector evaluators (Education, Training, Experience, Eligibility, and Document Verification). Each sector marks you as qualified or disqualified. Your general status — Qualified, Disqualified, or Pending — is determined based on the overall evaluation results.</p>
                        </div>
                    </div>
                    <!-- Q5 -->
                    <div class="faq-item" style="border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-lg); overflow: hidden;">
                        <button onclick="this.parentElement.classList.toggle('open')" style="width: 100%; background: none; border: none; padding: var(--spacing-lg); text-align: left; font: inherit; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <span class="font-title-sm">How do I track my application status?</span>
                            <span class="faq-icon" style="font-size: 20px; transition: transform 0.2s;">+</span>
                        </button>
                        <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease; padding: 0 var(--spacing-lg);">
                            <p class="font-body-sm text-body" style="padding-bottom: var(--spacing-lg);">Log in to your account and go to your dashboard. You will see a list of all your submitted applications along with their current status. You can click on any application to view detailed evaluation results from each sector.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .faq-item.open .faq-icon { transform: rotate(45deg); }
            .faq-item.open .faq-answer { max-height: 300px !important; }
        </style>

        <script>
            window.jobsData = <?php echo json_encode($allJobPostings->map(fn($j) => [
                'id' => $j->id,
                'position_name' => $j->plantillaPosition->position_name,
                'department' => $j->plantillaPosition->department,
                'salary_grade' => $j->plantillaPosition->salary_grade,
                'monthly_salary' => number_format($j->monthly_salary, 2),
                'description' => $j->description,
                'required_education' => $j->required_education,
                'required_training' => $j->required_training,
                'required_experience' => $j->required_experience,
                'required_eligibility' => $j->required_eligibility,
                'requirements' => $j->requirements,
                'deadline' => $j->deadline->format('M d, Y'),
                'posted_at' => $j->posted_at?->format('M d, Y') ?? 'N/A',
                'applications_count' => $j->applications_count,
                'job_description_pdf' => $j->job_description_pdf,
            ])) ?>;
            window.isAuthenticated = <?php echo json_encode(auth()->check()) ?>;
        </script>

        <!-- Job Detail Modal -->
        <div class="modal-overlay" id="jobDetailModal" onclick="closeModal('jobDetailModal')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <button class="modal-close" onclick="closeModal('jobDetailModal')">&times;</button>
                <div id="jobModalBody">
                    <h2 class="font-display-md" id="modalJobTitle" style="margin-bottom: 4px;"></h2>
                    <span class="dept-tag" id="modalJobDept"></span>
                    <div class="modal-divider"></div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm); margin-bottom: var(--spacing-base);">
                        <div><span class="font-caption text-muted">Salary Grade</span><br><span class="font-body-sm" id="modalJobSG"></span></div>
                        <div><span class="font-caption text-muted">Monthly Salary</span><br><span class="font-body-sm" id="modalJobSalary"></span></div>
                        <div><span class="font-caption text-muted">Posted</span><br><span class="font-body-sm" id="modalJobPosted"></span></div>
                        <div><span class="font-caption text-muted">Deadline</span><br><span class="font-body-sm" id="modalJobDeadline"></span></div>
                        <div><span class="font-caption text-muted">Applicants</span><br><span class="font-body-sm" id="modalJobApplicants"></span></div>
                    </div>
                    <div class="modal-divider"></div>
                    <h3 class="font-title-sm" style="margin-bottom: var(--spacing-xs);">Description</h3>
                    <p class="font-body-sm text-body" id="modalJobDesc" style="margin-bottom: var(--spacing-base);"></p>
                    <h3 class="font-title-sm" style="margin-bottom: var(--spacing-xs);">Qualification Standards</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm); margin-bottom: var(--spacing-base);">
                        <div><span class="font-caption text-muted">Education</span><br><span class="font-body-sm" id="modalJobEdu"></span></div>
                        <div><span class="font-caption text-muted">Training</span><br><span class="font-body-sm" id="modalJobTraining"></span></div>
                        <div><span class="font-caption text-muted">Experience</span><br><span class="font-body-sm" id="modalJobExp"></span></div>
                        <div><span class="font-caption text-muted">Eligibility</span><br><span class="font-body-sm" id="modalJobElig"></span></div>
                    </div>
                    <div id="modalJobPdfRow" style="display: none; margin-bottom: var(--spacing-base);">
                        <a id="modalJobPdfLink" href="#" target="_blank" class="btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center; gap: var(--spacing-xs);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            View Job Description (PDF)
                        </a>
                    </div>
                    <div class="modal-divider"></div>
                    <div style="text-align: center; padding-top: var(--spacing-sm);">
                        <a id="modalApplyBtn" class="btn-primary" style="text-decoration: none;">Apply Now</a>
                        <p class="font-caption text-muted" id="modalApplyHint" style="margin-top: var(--spacing-xs);"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Positions Modal -->
        <div class="modal-overlay" id="viewAllModal" onclick="closeModal('viewAllModal')">
            <div class="modal-content" onclick="event.stopPropagation()" style="max-width: 800px;">
                <button class="modal-close" onclick="closeModal('viewAllModal')">&times;</button>
                <h2 class="font-display-md" style="margin-bottom: var(--spacing-lg);">All Open Positions</h2>
                <div style="display: flex; flex-direction: column; gap: var(--spacing-sm);" id="viewAllList">
                    @foreach ($allJobPostings as $job)
                        <div class="job-card" style="padding: var(--spacing-base);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 class="font-title-sm" style="margin-bottom: 2px;">{{ $job->plantillaPosition->position_name }}</h3>
                                    <span class="dept-tag" style="font-size: 11px;">{{ $job->plantillaPosition->department }}</span>
                                    <span class="font-caption text-muted" style="margin-left: var(--spacing-sm);">SG {{ $job->plantillaPosition->salary_grade }} &middot; {{ $job->applications_count > 0 ? $job->applications_count . ' applicant' . ($job->applications_count > 1 ? 's' : '') : 'No applicants yet' }}</span>
                                </div>
                                <button onclick="closeModal('viewAllModal'); openJobModal({{ $job->id }})" class="btn-secondary" style="padding: 6px 12px; height: 32px; font-size: 12px;">View</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            function openJobModal(jobId) {
                const job = window.jobsData.find(j => j.id === jobId);
                if (!job) return;

                document.getElementById('modalJobTitle').textContent = job.position_name;
                document.getElementById('modalJobDept').textContent = job.department;
                document.getElementById('modalJobSG').textContent = 'SG ' + job.salary_grade;
                document.getElementById('modalJobSalary').textContent = '\u20B1' + job.monthly_salary;
                document.getElementById('modalJobPosted').textContent = job.posted_at;
                document.getElementById('modalJobDeadline').textContent = job.deadline;
                document.getElementById('modalJobApplicants').textContent = job.applications_count > 0 ? job.applications_count + ' applicant' + (job.applications_count > 1 ? 's' : '') : 'No applicants yet';
                document.getElementById('modalJobDesc').textContent = job.description;
                document.getElementById('modalJobEdu').textContent = job.required_education || 'None';
                document.getElementById('modalJobTraining').textContent = job.required_training || 'None';
                document.getElementById('modalJobExp').textContent = job.required_experience || 'None';
                document.getElementById('modalJobElig').textContent = job.required_eligibility || 'None';

                const pdfRow = document.getElementById('modalJobPdfRow');
                const pdfLink = document.getElementById('modalJobPdfLink');
                if (job.job_description_pdf) {
                    pdfRow.style.display = 'block';
                    pdfLink.href = '/storage/' + job.job_description_pdf;
                } else {
                    pdfRow.style.display = 'none';
                }

                const applyBtn = document.getElementById('modalApplyBtn');
                const applyHint = document.getElementById('modalApplyHint');
                if (window.isAuthenticated) {
                    applyBtn.href = '/applicant/jobs/' + job.id + '/apply';
                    applyBtn.textContent = 'Apply Now';
                    applyHint.textContent = '';
                } else {
                    applyBtn.href = '{{ route('register') }}';
                    applyBtn.textContent = 'Create Account to Apply';
                    applyHint.textContent = 'You need an account to apply for this position.';
                }

                openModal('jobDetailModal');
            }

            function openViewAllModal() {
                openModal('viewAllModal');
            }

            function openModal(id) {
                document.getElementById(id).classList.add('open');
                document.body.classList.add('modal-open');
            }

            function closeModal(id) {
                document.getElementById(id).classList.remove('open');
                document.body.classList.remove('modal-open');
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-overlay.open').forEach(function (el) {
                        el.classList.remove('open');
                    });
                    document.body.classList.remove('modal-open');
                }
            });
        </script>

        <!-- Footer -->
        <footer style="background: var(--color-canvas); padding: 48px; border-top: 1px solid var(--color-hairline);">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: var(--spacing-lg);">
                    <div>
                        <div style="font-weight: 600; font-size: 16px; color: var(--color-ink); margin-bottom: var(--spacing-xs);">DEPED Region V Recruitment</div>
                        <p class="font-body-sm text-muted">Department of Education - Regional Office V</p>
                    </div>
                    <div style="display: flex; gap: var(--spacing-lg);">
                        <a href="#" class="font-body-sm" style="color: var(--color-body); text-decoration: none;">Privacy Policy</a>
                        <a href="#" class="font-body-sm" style="color: var(--color-body); text-decoration: none;">Terms of Service</a>
                        <a href="#" class="font-body-sm" style="color: var(--color-body); text-decoration: none;">Contact Us</a>
                    </div>
                </div>
                <div style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 1px solid var(--color-hairline); text-align: center;">
                    <p class="font-caption text-muted">&copy; {{ date('Y') }} DEPED Region V. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>