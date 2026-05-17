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
                    <!-- Job Card 1 -->
                    <div class="job-card">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                            <div>
                                <h3 class="font-title-md" style="margin-bottom: 4px;">Teacher I - Elementary</h3>
                                <span class="dept-tag">Division of Albay</span>
                            </div>
                            <span class="badge-pill">Open</span>
                        </div>
                        <p class="font-body-sm text-body" style="margin-bottom: var(--spacing-base);">Teaching position for Grades 1-3. Minimum requirement: Bachelor of Elementary Education.</p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span class="font-caption text-muted">Salary Grade 11</span>
                                <span class="font-caption text-muted" style="margin-left: var(--spacing-base);">5 openings</span>
                            </div>
                            <a href="#" class="btn-secondary" style="padding: 8px 16px; height: 36px; font-size: 13px;">View Details</a>
                        </div>
                    </div>

                    <!-- Job Card 2 -->
                    <div class="job-card">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                            <div>
                                <h3 class="font-title-md" style="margin-bottom: 4px;">Administrative Officer III</h3>
                                <span class="dept-tag">Regional Office</span>
                            </div>
                            <span class="badge-pill">Open</span>
                        </div>
                        <p class="font-body-sm text-body" style="margin-bottom: var(--spacing-base);">Administrative position handling records management and personnel services.</p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span class="font-caption text-muted">Salary Grade 15</span>
                                <span class="font-caption text-muted" style="margin-left: var(--spacing-base);">2 openings</span>
                            </div>
                            <a href="#" class="btn-secondary" style="padding: 8px 16px; height: 36px; font-size: 13px;">View Details</a>
                        </div>
                    </div>

                    <!-- Job Card 3 -->
                    <div class="job-card">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                            <div>
                                <h3 class="font-title-md" style="margin-bottom: 4px;">School Head - Secondary</h3>
                                <span class="dept-tag">Division of Camarines Sur</span>
                            </div>
                            <span class="badge-pill">Open</span>
                        </div>
                        <p class="font-body-sm text-body" style="margin-bottom: var(--spacing-base);">School leadership position. Minimum 5 years teaching experience required.</p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span class="font-caption text-muted">Salary Grade 24</span>
                                <span class="font-caption text-muted" style="margin-left: var(--spacing-base);">1 opening</span>
                            </div>
                            <a href="#" class="btn-secondary" style="padding: 8px 16px; height: 36px; font-size: 13px;">View Details</a>
                        </div>
                    </div>

                    <!-- Job Card 4 -->
                    <div class="job-card">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-sm);">
                            <div>
                                <h3 class="font-title-md" style="margin-bottom: 4px;">Guidance Counselor II</h3>
                                <span class="dept-tag">Division of Sorsogon</span>
                            </div>
                            <span class="badge-pill" style="background: #fef3c7; color: #92400e;">Urgent</span>
                        </div>
                        <p class="font-body-sm text-body" style="margin-bottom: var(--spacing-base);">Provides counseling services to students. RPm license required.</p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span class="font-caption text-muted">Salary Grade 16</span>
                                <span class="font-caption text-muted" style="margin-left: var(--spacing-base);">3 openings</span>
                            </div>
                            <a href="#" class="btn-secondary" style="padding: 8px 16px; height: 36px; font-size: 13px;">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- View All Link -->
                <div style="text-align: center; margin-top: var(--spacing-xl);">
                    <a href="#" class="text-link font-body-md">View all open positions &rarr;</a>
                </div>
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

        <!-- CTA Section -->
        <section style="padding: var(--spacing-section) 0; background: var(--color-canvas);">
            <div class="container" style="text-align: center;">
                <h2 class="font-display-lg" style="margin-bottom: var(--spacing-lg);">Ready to Start Your Career?</h2>
                <p class="font-body-md text-body" style="margin-bottom: var(--spacing-xl); max-width: 500px; margin-left: auto; margin-right: auto;">
                    Create an account now to start applying for positions in DEPED Region V.
                </p>
                <a href="{{ route('register') }}" class="btn-primary">Create Account</a>
            </div>
        </section>

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