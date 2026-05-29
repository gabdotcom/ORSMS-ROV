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
            .hero-gradient {
                background: radial-gradient(ellipse 80% 50% at 50% 0%, #0057B8 0%, #004494 40%, transparent 70%);
            }
            .modal-overlay.open { display: flex; }
            body.modal-open { overflow: hidden; }
            .faq-item.open .faq-icon { transform: rotate(45deg); }
            .faq-item.open .faq-answer { max-height: 300px !important; }
        </style>
    </head>
    <body class="font-sans bg-canvas text-ink leading-normal">
        <!-- Header -->
        <header class="bg-canvas border-b border-hairline">
            <div class="max-w-[1200px] mx-auto px-lg h-16 flex items-center justify-between">
                <div class="flex items-center gap-sm">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0057B8" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-lg text-ink">DEPED Region V</div>
                        <div class="text-caption text-muted">Recruitment Management System</div>
                    </div>
                </div>
                <nav class="flex items-center gap-base">
                    <a href="#jobs" class="text-nav-link text-ink no-underline">Job Openings</a>
                    <a href="#" class="text-nav-link text-ink no-underline">About</a>
                    <a href="#" class="text-nav-link text-ink no-underline">FAQs</a>
                    <a href="{{ route('login') }}" class="text-nav-link text-ink no-underline">Sign In</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center h-10 px-[18px] py-[10px] bg-primary text-on-primary text-button rounded-md no-underline border-none cursor-pointer hover:bg-primary-active">Apply Now</a>
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-gradient py-section">
            <div class="max-w-[1200px] mx-auto px-lg text-center">
                <span class="bg-surface-strong text-ink text-caption-uppercase uppercase rounded-pill px-[10px] py-[4px] mb-base inline-block">Online Recruitment System</span>
                <h1 class="text-display-mega text-ink max-w-[800px] mx-auto mb-lg">
                    Join the Department of Education Region V
                </h1>
                <p class="text-body-md text-body max-w-[600px] mx-auto mb-xl">
                    Find your next opportunity in education. Browse available positions, track your applications, and manage your career journey with us.
                </p>
                <div class="flex gap-sm justify-center">
                    <a href="#jobs" class="inline-flex items-center justify-center h-10 px-[18px] py-[10px] bg-primary text-on-primary text-button rounded-md no-underline border-none cursor-pointer hover:bg-primary-active">View Open Positions</a>
                    <a href="#" class="inline-flex items-center justify-center h-10 px-[17px] py-[9px] bg-surface-card text-ink text-button rounded-md no-underline border border-hairline-strong cursor-pointer hover:bg-surface-strong">How to Apply</a>
                </div>
            </div>
        </section>

        <!-- Job Search Section -->
        <section id="jobs" class="py-section bg-canvas">
            <div class="max-w-[1200px] mx-auto px-lg">
                <h2 class="text-display-lg mb-lg">Available Positions</h2>

                <!-- Search Bar -->
                <div class="flex gap-sm mb-xl max-w-[600px]">
                    <input type="text" class="bg-surface-card border border-hairline-strong rounded-md px-base py-3 text-body-md w-full h-[44px] placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-ink" placeholder="Search by position, department, or keywords...">
                    <button class="inline-flex items-center justify-center h-10 px-[18px] py-[10px] bg-primary text-on-primary text-button rounded-md no-underline border-none cursor-pointer hover:bg-primary-active">Search</button>
                </div>

                <!-- Job Listings -->
                <div class="grid grid-cols-2 gap-lg">
                    @forelse ($jobPostings as $job)
                        <div class="bg-surface-card border border-hairline-strong rounded-lg p-lg transition-shadow duration-200 hover:shadow-soft">
                            <div class="flex justify-between items-start mb-sm">
                                <div>
                                    <h3 class="text-title-md mb-[4px]">{{ $job->plantillaPosition->position_name }}</h3>
                                    <span class="text-[12px] text-body bg-surface-strong px-[8px] py-[2px] rounded-xs">{{ $job->plantillaPosition->department }}</span>
                                </div>
                                <span class="bg-semantic-success text-white text-caption-uppercase uppercase rounded-pill px-[10px] py-[4px]">Open</span>
                            </div>
                            <p class="text-body-sm text-body mb-base">{{ $job->description }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col gap-[2px]">
                                    <span class="text-caption text-muted">Salary Grade {{ $job->plantillaPosition->salary_grade }}</span>
                                    <span class="text-caption text-muted">Posted {{ $job->posted_at?->format('M d, Y') ?? 'N/A' }}</span>
                                    <span class="text-caption text-muted">{{ $job->applications_count > 0 ? $job->applications_count . ' applicant' . ($job->applications_count > 1 ? 's' : '') : 'No applicants yet' }} &middot; Deadline: {{ $job->deadline->format('M d, Y') }}</span>
                                </div>
                                <button onclick="openJobModal({{ $job->id }})" class="inline-flex items-center justify-center bg-surface-card text-ink border border-hairline-strong rounded-md cursor-pointer hover:bg-surface-strong px-3 py-1.5 h-8 text-caption self-end">View Details</button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-xxl">
                            <p class="text-body-md text-muted">No open positions at the moment. Please check back later.</p>
                        </div>
                    @endforelse
                </div>

                @if ($allJobPostings->isNotEmpty())
                    <div class="text-center mt-xl">
                        <button onclick="openViewAllModal()" class="bg-transparent border-none cursor-pointer font-sans text-body-md text-text-link no-underline hover:underline">View all open positions &rarr;</button>
                    </div>
                @endif
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-section bg-canvas-soft">
            <div class="max-w-[1200px] mx-auto px-lg">
                <h2 class="text-display-lg text-center mb-xxl">How to Apply</h2>
                <div class="grid grid-cols-4 gap-lg">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-surface-strong rounded-full flex items-center justify-center mx-auto mb-base font-semibold text-lg">1</div>
                        <h3 class="text-title-sm mb-xs">Create Account</h3>
                        <p class="text-body-sm text-body">Register with your email and basic information</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-surface-strong rounded-full flex items-center justify-center mx-auto mb-base font-semibold text-lg">2</div>
                        <h3 class="text-title-sm mb-xs">Complete Profile</h3>
                        <p class="text-body-sm text-body">Fill in your personal information and qualifications</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-surface-strong rounded-full flex items-center justify-center mx-auto mb-base font-semibold text-lg">3</div>
                        <h3 class="text-title-sm mb-xs">Submit Application</h3>
                        <p class="text-body-sm text-body">Apply to positions with required documents</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-surface-strong rounded-full flex items-center justify-center mx-auto mb-base font-semibold text-lg">4</div>
                        <h3 class="text-title-sm mb-xs">Track Status</h3>
                        <p class="text-body-sm text-body">Monitor your application status online</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-section bg-canvas">
            <div class="max-w-[720px] mx-auto px-lg">
                <h2 class="text-display-lg text-center mb-xxl">Frequently Asked Questions</h2>
                <div class="flex flex-col gap-sm">
                    <!-- Q1 -->
                    <div class="faq-item border border-hairline-strong rounded-lg overflow-hidden">
                        <button onclick="this.parentElement.classList.toggle('open')" class="w-full bg-transparent border-none p-lg text-left font-[inherit] cursor-pointer flex justify-between items-center">
                            <span class="text-title-sm">How do I create an account?</span>
                            <span class="faq-icon text-[20px] transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-[max-height] duration-300 ease px-lg">
                            <p class="text-body-sm text-body pb-lg">Click the "Apply Now" button on the top right or the "Create Account" button below. Fill in your email address, full name, and create a password. After registration, you can complete your profile with your personal information, education, training, and work experience.</p>
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="faq-item border border-hairline-strong rounded-lg overflow-hidden">
                        <button onclick="this.parentElement.classList.toggle('open')" class="w-full bg-transparent border-none p-lg text-left font-[inherit] cursor-pointer flex justify-between items-center">
                            <span class="text-title-sm">How do I apply for a job?</span>
                            <span class="faq-icon text-[20px] transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-[max-height] duration-300 ease px-lg">
                            <p class="text-body-sm text-body pb-lg">Once your profile is complete, browse the Available Positions section on this page. Click "View Details" on a position you're interested in, then click "Apply" to submit your application. You can track all your applications on your applicant dashboard after logging in.</p>
                        </div>
                    </div>
                    <!-- Q3 -->
                    <div class="faq-item border border-hairline-strong rounded-lg overflow-hidden">
                        <button onclick="this.parentElement.classList.toggle('open')" class="w-full bg-transparent border-none p-lg text-left font-[inherit] cursor-pointer flex justify-between items-center">
                            <span class="text-title-sm">What documents do I need to submit?</span>
                            <span class="faq-icon text-[20px] transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-[max-height] duration-300 ease px-lg">
                            <p class="text-body-sm text-body pb-lg">You will need your Diploma, Transcript of Records (TOR), Certificate of Employment (COE), eligibility (if applicable), and other relevant training certificates. Upload these documents in your profile before applying to a position.</p>
                        </div>
                    </div>
                    <!-- Q4 -->
                    <div class="faq-item border border-hairline-strong rounded-lg overflow-hidden">
                        <button onclick="this.parentElement.classList.toggle('open')" class="w-full bg-transparent border-none p-lg text-left font-[inherit] cursor-pointer flex justify-between items-center">
                            <span class="text-title-sm">How are applications evaluated?</span>
                            <span class="faq-icon text-[20px] transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-[max-height] duration-300 ease px-lg">
                            <p class="text-body-sm text-body pb-lg">Each application is reviewed by sector evaluators (Education, Training, Experience, Eligibility, and Document Verification). Each sector marks you as qualified or disqualified. Your general status &mdash; Qualified, Disqualified, or Pending &mdash; is determined based on the overall evaluation results.</p>
                        </div>
                    </div>
                    <!-- Q5 -->
                    <div class="faq-item border border-hairline-strong rounded-lg overflow-hidden">
                        <button onclick="this.parentElement.classList.toggle('open')" class="w-full bg-transparent border-none p-lg text-left font-[inherit] cursor-pointer flex justify-between items-center">
                            <span class="text-title-sm">How do I track my application status?</span>
                            <span class="faq-icon text-[20px] transition-transform duration-200">+</span>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-[max-height] duration-300 ease px-lg">
                            <p class="text-body-sm text-body pb-lg">Log in to your account and go to your dashboard. You will see a list of all your submitted applications along with their current status. You can click on any application to view detailed evaluation results from each sector.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
        <div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden justify-center items-center overflow-y-auto p-lg" id="jobDetailModal" onclick="closeModal('jobDetailModal')">
            <div class="bg-canvas rounded-xl max-w-[640px] w-full p-xl relative max-h-[90vh] overflow-y-auto shadow-[0_20px_60px_rgba(0,0,0,0.3)]" onclick="event.stopPropagation()">
                <button class="absolute top-base right-base bg-transparent border-none text-2xl cursor-pointer text-muted w-8 h-8 flex items-center justify-center rounded-full hover:bg-surface-strong hover:text-ink" onclick="closeModal('jobDetailModal')">&times;</button>
                <div id="jobModalBody">
                    <h2 class="text-display-md mb-[4px]" id="modalJobTitle"></h2>
                    <span class="text-[12px] text-body bg-surface-strong px-[8px] py-[2px] rounded-xs" id="modalJobDept"></span>
                    <div class="h-[1px] bg-hairline-strong my-base"></div>
                    <div class="grid grid-cols-2 gap-sm mb-base">
                        <div><span class="text-caption text-muted">Salary Grade</span><br><span class="text-body-sm" id="modalJobSG"></span></div>
                        <div><span class="text-caption text-muted">Monthly Salary</span><br><span class="text-body-sm" id="modalJobSalary"></span></div>
                        <div><span class="text-caption text-muted">Posted</span><br><span class="text-body-sm" id="modalJobPosted"></span></div>
                        <div><span class="text-caption text-muted">Deadline</span><br><span class="text-body-sm" id="modalJobDeadline"></span></div>
                        <div><span class="text-caption text-muted">Applicants</span><br><span class="text-body-sm" id="modalJobApplicants"></span></div>
                    </div>
                    <div class="h-[1px] bg-hairline-strong my-base"></div>
                    <h3 class="text-title-sm mb-xs">Description</h3>
                    <p class="text-body-sm text-body mb-base" id="modalJobDesc"></p>
                    <h3 class="text-title-sm mb-xs">Qualification Standards</h3>
                    <div class="grid grid-cols-2 gap-sm mb-base">
                        <div><span class="text-caption text-muted">Education</span><br><span class="text-body-sm" id="modalJobEdu"></span></div>
                        <div><span class="text-caption text-muted">Training</span><br><span class="text-body-sm" id="modalJobTraining"></span></div>
                        <div><span class="text-caption text-muted">Experience</span><br><span class="text-body-sm" id="modalJobExp"></span></div>
                        <div><span class="text-caption text-muted">Eligibility</span><br><span class="text-body-sm" id="modalJobElig"></span></div>
                    </div>
                    <div id="modalJobPdfRow" class="hidden mb-base">
                        <a id="modalJobPdfLink" href="#" target="_blank" class="inline-flex items-center justify-center bg-surface-card text-ink text-button rounded-md border border-hairline-strong cursor-pointer hover:bg-surface-strong no-underline gap-xs" style="padding: 8px 16px; height: 36px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            View Job Description (PDF)
                        </a>
                    </div>
                    <div class="h-[1px] bg-hairline-strong my-base"></div>
                    <div class="text-center pt-sm">
                        <a id="modalApplyBtn" class="inline-flex items-center justify-center h-10 px-[18px] py-[10px] bg-primary text-on-primary text-button rounded-md no-underline border-none cursor-pointer hover:bg-primary-active" style="text-decoration: none;">Apply Now</a>
                        <p class="text-caption text-muted mt-xs" id="modalApplyHint"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Positions Modal -->
        <div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden justify-center items-center overflow-y-auto p-lg" id="viewAllModal" onclick="closeModal('viewAllModal')">
            <div class="bg-canvas rounded-xl max-w-[800px] w-full p-xl relative max-h-[90vh] overflow-y-auto shadow-[0_20px_60px_rgba(0,0,0,0.3)]" onclick="event.stopPropagation()">
                <button class="absolute top-base right-base bg-transparent border-none text-2xl cursor-pointer text-muted w-8 h-8 flex items-center justify-center rounded-full hover:bg-surface-strong hover:text-ink" onclick="closeModal('viewAllModal')">&times;</button>
                <h2 class="text-display-md mb-lg">All Open Positions</h2>
                <div class="flex flex-col gap-sm" id="viewAllList">
                    @foreach ($allJobPostings as $job)
                        <div class="bg-surface-card border border-hairline-strong rounded-lg p-base">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-title-sm mb-[2px]">{{ $job->plantillaPosition->position_name }}</h3>
                                    <span class="text-[11px] text-body bg-surface-strong px-[8px] py-[2px] rounded-xs">{{ $job->plantillaPosition->department }}</span>
                                    <span class="text-caption text-muted ml-sm">SG {{ $job->plantillaPosition->salary_grade }} &middot; {{ $job->applications_count > 0 ? $job->applications_count . ' applicant' . ($job->applications_count > 1 ? 's' : '') : 'No applicants yet' }}</span>
                                </div>
                                <button onclick="closeModal('viewAllModal'); openJobModal({{ $job->id }})" class="inline-flex items-center justify-center bg-surface-card text-ink border border-hairline-strong rounded-md cursor-pointer hover:bg-surface-strong px-3 py-1 h-7 text-caption">View</button>
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
                    pdfRow.classList.remove('hidden');
                    pdfLink.href = '/storage/' + job.job_description_pdf;
                } else {
                    pdfRow.classList.add('hidden');
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
        <footer class="bg-canvas p-xxl border-t border-hairline">
            <div class="max-w-[1200px] mx-auto px-lg">
                <div class="flex justify-between items-center flex-wrap gap-lg">
                    <div>
                        <div class="font-semibold text-base text-ink mb-xs">DEPED Region V Recruitment</div>
                        <p class="text-body-sm text-muted">Department of Education - Regional Office V</p>
                    </div>
                    <div class="flex gap-lg">
                        <a href="#" class="text-body-sm text-body no-underline">Privacy Policy</a>
                        <a href="#" class="text-body-sm text-body no-underline">Terms of Service</a>
                        <a href="#" class="text-body-sm text-body no-underline">Contact Us</a>
                    </div>
                </div>
                <div class="mt-lg pt-lg border-t border-hairline text-center">
                    <p class="text-caption text-muted">&copy; {{ date('Y') }} DEPED Region V. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
