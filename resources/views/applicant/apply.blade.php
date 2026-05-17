<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Apply for Position - DEPED Region V Recruitment</title>
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
            .header { background: var(--color-surface-card); border-bottom: 1px solid var(--color-hairline); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; }
            .logo { display: flex; align-items: center; gap: 10px; }
            .logo svg { width: 28px; height: 28px; }
            .logo-text { font-weight: 600; font-size: 16px; }
            .logo-text span { color: var(--color-primary); }
            .header-actions a { color: var(--color-body); text-decoration: none; margin-left: 20px; }
            .main-content { max-width: 900px; margin: 0 auto; padding: 32px; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 8px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 24px; margin-bottom: 24px; }
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 20px; }
            .section-title { font-size: 14px; font-weight: 600; color: var(--color-body); margin-bottom: 12px; }
            .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 16px; }
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
            .form-textarea { min-height: 80px; resize: vertical; }
            .required { color: #dc2626; }
            .entry-card { border: 1px solid var(--color-hairline); border-radius: var(--rounded-md); padding: 16px; margin-bottom: 12px; background: var(--color-canvas-soft); }
            .entry-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
            .entry-title { font-weight: 500; font-size: 14px; }
            .btn-remove { color: #dc2626; background: none; border: none; cursor: pointer; font-size: 13px; }
            .btn-add { background: var(--color-surface-strong); color: var(--color-ink); padding: 8px 16px; border-radius: var(--rounded-md); border: none; cursor: pointer; font-size: 13px; font-weight: 500; }
            .btn-add:hover { background: var(--color-hairline); }
            .btn-primary {
                background: var(--color-primary);
                color: white;
                font-size: 14px;
                font-weight: 500;
                padding: 12px 24px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
            }
            .btn-primary:hover { background: var(--color-primary-hover); }
            .btn-secondary {
                background: var(--color-surface-strong);
                color: var(--color-ink);
                font-size: 14px;
                font-weight: 500;
                padding: 12px 24px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
            }
            .form-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px; }
            .job-info-box { background: var(--color-canvas-soft); border-radius: var(--rounded-md); padding: 16px; margin-bottom: 24px; }
            .job-info-box h3 { font-size: 16px; margin-bottom: 4px; }
            .job-info-box p { font-size: 14px; color: var(--color-body); }
            .checkbox-group { display: flex; gap: 8px; align-items: center; }
            .checkbox-group input { width: auto; }
        </style>
    </head>
    <body>
        <header class="header">
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0057B8" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                    <path d="M2 17l10 5 10-5"></path>
                    <path d="M2 12l10 5 10-5"></path>
                </svg>
                <span class="logo-text">DEPED<span>ROV</span></span>
            </div>
            <div class="header-actions">
                <a href="{{ route('applicant.jobs') }}">Back to Jobs</a>
            </div>
        </header>

        <main class="main-content">
            <h1 class="page-title">Apply for Position</h1>
            <p class="page-subtitle">Complete the form below to submit your application</p>

            <div class="job-info-box">
                <h3>{{ $jobPosting->plantillaPosition->position_name ?? 'Position' }}</h3>
                <p>{{ $jobPosting->plantillaPosition->department ?? 'Department' }} | SG-{{ $jobPosting->plantillaPosition->salary_grade ?? '-' }}</p>
            </div>

            <form method="POST" action="{{ route('applicant.store-application', $jobPosting->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-title">Personal Information</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name <span class="required">*</span></label>
                            <input type="text" name="first_name" class="form-input" value="{{ auth()->user()->first_name }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" class="form-input" value="{{ auth()->user()->last_name }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-input" value="{{ auth()->user()->middle_name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Extension Name</label>
                            <input type="text" name="extension_name" class="form-input" value="{{ auth()->user()->extension_name }}">
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-input" value="{{ $profile->contact_number ?? '' }}">
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
                    <div class="form-group">
                        <label class="form-label">Zip Code</label>
                        <input type="text" name="zip_code" class="form-input" value="{{ $profile->zip_code ?? '' }}">
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Education</div>
                    <div id="educationContainer">
                        <div class="entry-card">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Level</label>
                                    <select name="educations[0][level]" class="form-select">
                                        <option value="Bachelors">Bachelors</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Doctorate">Doctorate</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">School Name</label>
                                    <input type="text" name="educations[0][school_name]" class="form-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Course</label>
                                    <input type="text" name="educations[0][course]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Year Graduated</label>
                                    <input type="number" name="educations[0][year_graduated]" class="form-input" min="1900" max="2100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Certificate (PDF/Image)</label>
                                <input type="file" name="educations[0][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Training</div>
                    <div id="trainingContainer">
                        <div class="entry-card">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Training Title</label>
                                    <input type="text" name="trainings[0][training_title]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Hours</label>
                                    <input type="number" name="trainings[0][training_hours]" class="form-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Date Conducted</label>
                                    <input type="date" name="trainings[0][date_conducted]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Certificate (PDF/Image)</label>
                                    <input type="file" name="trainings[0][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Work Experience</div>
                    <div id="experienceContainer">
                        <div class="entry-card">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Employer</label>
                                    <input type="text" name="experiences[0][employer]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="experiences[0][position]" class="form-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="experiences[0][start_date]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="experiences[0][end_date]" class="form-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Sector</label>
                                    <select name="experiences[0][sector]" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Government">Government</option>
                                        <option value="Private">Private</option>
                                        <option value="NGO">NGO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Proof (PDF/Image)</label>
                                    <input type="file" name="experiences[0][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Eligibility</div>
                    <div id="eligibilityContainer">
                        <div class="entry-card">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Eligibility Type</label>
                                    <select name="eligibilities[0][eligibility_type_id]" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($eligibilityTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">License Number</label>
                                    <input type="text" name="eligibilities[0][license_no]" class="form-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Date Issued</label>
                                    <input type="date" name="eligibilities[0][date_issued]" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Certificate (PDF/Image)</label>
                                    <input type="file" name="eligibilities[0][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($documentTypes->count() > 0)
                <div class="card">
                    <div class="card-title">Additional Documents</div>
                    @foreach($documentTypes as $doc)
                        <div class="form-group">
                            <label class="form-label">{{ $doc->name }} {{ $doc->is_required ? '*' : '' }}</label>
                            <input type="file" name="documents[{{ $doc->id }}][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png" {{ $doc->is_required ? 'required' : '' }}>
                        </div>
                    @endforeach
                </div>
                @endif

                <div class="form-actions">
                    <a href="{{ route('applicant.jobs') }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary">Submit Application</button>
                </div>
            </form>
        </main>
    </body>
</html>