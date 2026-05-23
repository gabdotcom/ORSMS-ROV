<style>
    .step-container { padding: 20px 0; }
    .step-indicator { display: flex; justify-content: space-between; margin-bottom: 24px; position: relative; overflow-x: auto; padding-bottom: 8px; }
    .step-indicator::before { content: ''; position: absolute; top: 14px; left: 0; right: 0; height: 2px; background: var(--color-hairline-strong); z-index: 0; }
    .step-item { position: relative; z-index: 1; text-align: center; flex: 1; min-width: 60px; }
    .step-dot { width: 28px; height: 28px; border-radius: 50%; background: var(--color-surface-card); border: 2px solid var(--color-hairline-strong); display: flex; align-items: center; justify-content: center; margin: 0 auto 6px; font-size: 12px; font-weight: 600; color: var(--color-muted); }
    .step-item.active .step-dot { background: var(--color-primary); border-color: var(--color-primary); color: white; }
    .step-item.completed .step-dot { background: var(--color-semantic-success); border-color: var(--color-semantic-success); color: white; }
    .step-label { font-size: 10px; color: var(--color-muted); white-space: nowrap; }
    .step-item.active .step-label { color: var(--color-primary); font-weight: 500; }
    .step-content { display: none; }
    .step-content.active { display: block; }
    .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px; }
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid var(--color-hairline-strong);
        border-radius: var(--rounded-md);
        font-size: 14px;
        font-family: var(--font-sans);
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--color-primary); }
    .form-textarea { min-height: 100px; resize: vertical; }
    .required { color: #dc2626; }
    .entry-card { border: 1px solid var(--color-hairline); border-radius: var(--rounded-md); padding: 20px; margin-bottom: 16px; background: var(--color-canvas-soft); }
    .entry-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
    .entry-title { font-weight: 500; font-size: 14px; }
    .btn-remove { color: #dc2626; background: none; border: none; cursor: pointer; font-size: 13px; }
    .btn-add { background: var(--color-surface-strong); color: var(--color-ink); padding: 10px 20px; border-radius: var(--rounded-md); border: none; cursor: pointer; font-size: 14px; font-weight: 500; margin-top: 10px; }
    .btn-add:hover { background: var(--color-hairline); }
    .btn-nav { padding: 12px 28px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
    .btn-next { background: var(--color-primary); color: white; font-size: 14px; font-weight: 500; padding: 10px 18px; border: none; border-radius: var(--rounded-md); cursor: pointer; display: inline-flex; align-items: center; gap: 8px; height: 40px; }
    .btn-next:hover { background: var(--color-primary-hover); }
    .btn-prev { background: var(--color-surface-card); color: var(--color-ink); border: 1px solid var(--color-hairline-strong); font-size: 14px; font-weight: 500; padding: 8px 16px; border-radius: var(--rounded-md); cursor: pointer; display: inline-flex; align-items: center; gap: 6px; height: 36px; }
    .btn-prev:hover { background: var(--color-surface-strong); }
    .btn-submit { background: var(--color-primary); color: white; font-size: 14px; font-weight: 500; padding: 10px 18px; border: none; border-radius: var(--rounded-md); cursor: pointer; display: inline-flex; align-items: center; gap: 8px; height: 40px; }
    .btn-submit:hover { background: var(--color-primary-hover); }
    .btn-sm {
        padding: 4px 10px;
        font-size: 12px;
        height: 30px;
    }
    .form-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--color-hairline); }
    .job-info-box { background: var(--color-canvas-soft); border-radius: var(--rounded-md); padding: 16px; margin-bottom: 20px; }
    .job-info-box h3 { font-size: 16px; margin-bottom: 4px; }
    .job-info-box p { font-size: 14px; color: var(--color-body); }
    .summary-card { background: var(--color-canvas-soft); border-radius: var(--rounded-md); padding: 16px; margin-bottom: 12px; }
    .summary-title { font-weight: 600; font-size: 14px; margin-bottom: 8px; }
    .summary-item { display: flex; justify-content: space-between; padding: 6px 0; font-size: 13px; border-bottom: 1px solid var(--color-hairline); }
    .summary-item:last-child { border-bottom: none; }
    .summary-label { color: var(--color-body); }
    .summary-value { font-weight: 500; }
    .checkbox-group { display: flex; gap: 8px; align-items: center; }
    .checkbox-group input { width: auto; }
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
        --rounded-md: 8px;
        --rounded-lg: 12px;
    }
</style>

<div class="job-info-box">
    <h3>{{ $jobPosting->plantillaPosition->position_name ?? 'Position' }}</h3>
    <p>{{ $jobPosting->plantillaPosition->department ?? 'Department' }} | SG-{{ $jobPosting->plantillaPosition->salary_grade ?? '-' }}</p>
</div>

<form method="POST" id="applicationForm" action="{{ route('applicant.store-application', $jobPosting->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="job_id" value="{{ $jobPosting->id }}">

    <div class="step-indicator">
        <div class="step-item active" data-step="1">
            <div class="step-dot">1</div>
            <div class="step-label">Personal</div>
        </div>
        <div class="step-item" data-step="2">
            <div class="step-dot">2</div>
            <div class="step-label">Address</div>
        </div>
        <div class="step-item" data-step="3">
            <div class="step-dot">3</div>
            <div class="step-label">Education</div>
        </div>
        <div class="step-item" data-step="4">
            <div class="step-dot">4</div>
            <div class="step-label">Training</div>
        </div>
        <div class="step-item" data-step="5">
            <div class="step-dot">5</div>
            <div class="step-label">Experience</div>
        </div>
        <div class="step-item" data-step="6">
            <div class="step-dot">6</div>
            <div class="step-label">Eligibility</div>
        </div>
        <div class="step-item" data-step="7">
            <div class="step-dot">7</div>
            <div class="step-label">Documents</div>
        </div>
        <div class="step-item" data-step="8">
            <div class="step-dot">8</div>
            <div class="step-label">Review</div>
        </div>
    </div>

    <div class="step-container">
        <!-- Step 1: Personal Information -->
        <div class="step-content active" data-step="1">
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
            @php
    $dobValue = $profile && $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '';
@endphp
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-input" value="{{ $dobValue }}" onchange="calculateAge(this.value)">
                </div>
                <div class="form-group">
                    <label class="form-label">Age</label>
                    <input type="text" id="age_display" class="form-input" value="" readonly style="background: #f5f5f7;">
                    <input type="hidden" name="age" id="age" value="">
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

        <!-- Step 2: Address -->
        <div class="step-content" data-step="2">
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

        <!-- Step 3: Education -->
        <div class="step-content" data-step="3">
            <div id="educationContainer">
                <div class="entry-card" data-index="0">
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
                    <button type="button" class="btn-remove" onclick="removeEntry(this)">Remove</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addEducation()">+ Add Education</button>
        </div>

        <!-- Step 4: Training -->
        <div class="step-content" data-step="4">
            <div id="trainingContainer">
                <div class="entry-card" data-index="0">
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
                    <button type="button" class="btn-remove" onclick="removeEntry(this)">Remove</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addTraining()">+ Add Training</button>
        </div>

        <!-- Step 5: Experience -->
        <div class="step-content" data-step="5">
            <div id="experienceContainer">
                <div class="entry-card" data-index="0">
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
                    <button type="button" class="btn-remove" onclick="removeEntry(this)">Remove</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addExperience()">+ Add Experience</button>
        </div>

        <!-- Step 6: Eligibility -->
        <div class="step-content" data-step="6">
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

        <!-- Step 7: Additional Documents -->
        <div class="step-content" data-step="7">
            @if($documentTypes->count() > 0)
                @foreach($documentTypes as $doc)
                    <div class="form-group">
                        <label class="form-label">{{ $doc->name }} {{ $doc->is_required ? '*' : '' }}</label>
                        <input type="file" name="documents[{{ $doc->id }}][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png" {{ $doc->is_required ? 'required' : '' }}>
                    </div>
                @endforeach
            @else
                <p style="color: var(--color-muted); text-align: center; padding: 20px;">No additional documents required for this position.</p>
            @endif
        </div>

        <!-- Step 8: Review -->
        <div class="step-content" data-step="8">
            <div class="summary-card">
                <div class="summary-title">Personal Information</div>
                <div class="summary-item"><span class="summary-label">Name</span><span class="summary-value" id="summaryName">-</span></div>
                <div class="summary-item"><span class="summary-label">Gender</span><span class="summary-value" id="summaryGender">-</span></div>
                <div class="summary-item"><span class="summary-label">Civil Status</span><span class="summary-value" id="summaryCivilStatus">-</span></div>
                <div class="summary-item"><span class="summary-label">Contact</span><span class="summary-value" id="summaryContact">-</span></div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Address</div>
                <div class="summary-item"><span class="summary-label">Location</span><span class="summary-value" id="summaryAddress">-</span></div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Education</div>
                <div id="summaryEducation"></div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Training</div>
                <div id="summaryTraining"></div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Work Experience</div>
                <div id="summaryExperience"></div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Eligibility</div>
                <div id="summaryEligibility"></div>
            </div>
            <p style="font-size: 13px; color: var(--color-body); margin-top: 16px;">Please review your information before submitting. Click Submit to complete your application.</p>
        </div>
    </div>

    <div class="form-actions">
        <button type="button" class="btn-nav btn-prev" id="prevBtn" onclick="prevStep()" style="display: none;">Previous</button>
        <button type="button" class="btn-nav btn-next" id="nextBtn" onclick="nextStep()">Next</button>
        <button type="submit" class="btn-nav btn-submit" id="submitBtn" style="display: none;">Submit Application</button>
    </div>
</form>

<script>
    let currentStep = 1;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    function getCookie(name) {
        let cookieValue = null;
        if (document.cookie && document.cookie !== '') {
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                if (cookie.substring(0, name.length + 1) === (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }

    function calculateAge(birthdate) {
        if (!birthdate || birthdate === '') {
            document.getElementById('age_display').value = '';
            document.getElementById('age').value = '';
            return;
        }
        const birth = new Date(birthdate);
        if (isNaN(birth.getTime())) {
            document.getElementById('age_display').value = '';
            document.getElementById('age').value = '';
            return;
        }
        const today = new Date();
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        if (age < 0 || age > 150) {
            document.getElementById('age_display').value = '';
            document.getElementById('age').value = '';
            return;
        }
        document.getElementById('age_display').value = age;
        document.getElementById('age').value = age;
    }

    // Calculate age on page load if date exists
    document.addEventListener('DOMContentLoaded', function() {
        const dobInput = document.querySelector('input[name="date_of_birth"]');
        if (dobInput && dobInput.value) {
            calculateAge(dobInput.value);
        }
    });

    const totalSteps = 8;

    function updateStepDisplay() {
        document.querySelectorAll('.step-item').forEach((item, index) => {
            const step = index + 1;
            item.classList.remove('active', 'completed');
            if (step === currentStep) item.classList.add('active');
            if (step < currentStep) item.classList.add('completed');
        });

        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.remove('active');
            if (parseInt(content.dataset.step) === currentStep) {
                content.classList.add('active');
            }
        });

        document.getElementById('prevBtn').style.display = currentStep === 1 ? 'none' : 'inline-block';
        document.getElementById('nextBtn').style.display = currentStep === totalSteps ? 'none' : 'inline-block';
        document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'inline-block' : 'none';

        if (currentStep === totalSteps) {
            updateSummary();
        }
    }

    function nextStep() {
        // Validate current step before proceeding
        if (!validateStep(currentStep)) {
            return;
        }
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepDisplay();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    }

    function validateStep(step) {
        const form = document.getElementById('applicationForm');
        let isValid = true;
        let firstError = null;

        if (step === 1) {
            const requiredFields = ['first_name', 'last_name', 'date_of_birth', 'gender', 'civil_status', 'contact_number'];
            requiredFields.forEach(field => {
                const input = form.querySelector('[name="' + field + '"]');
                if (input && !input.value.trim()) {
                    isValid = false;
                    if (!firstError) firstError = input;
                    input.style.borderColor = '#dc2626';
                } else if (input) {
                    input.style.borderColor = '';
                }
            });
        }

        if (step === 2) {
            const addressFields = ['region', 'province', 'city', 'barangay', 'zip_code'];
            addressFields.forEach(field => {
                const input = form.querySelector('[name="' + field + '"]');
                if (input && !input.value.trim()) {
                    input.style.borderColor = '';
                }
            });
        }

        if (step === 3) {
            const eduContainer = document.getElementById('educationContainer');
            const eduCards = eduContainer.querySelectorAll('.entry-card');
            let hasEducation = false;
            eduCards.forEach(card => {
                const schoolName = card.querySelector('[name$="[school_name]"]');
                if (schoolName && schoolName.value.trim()) {
                    hasEducation = true;
                }
            });
            if (!hasEducation && eduCards.length > 0) {
                alert('Please add at least one education entry with school name');
                return false;
            }
        }

        if (!isValid) {
            alert('Please fill in all required fields');
            if (firstError) firstError.focus();
        }
        return isValid;
    }

    function updateSummary() {
        const form = document.getElementById('applicationForm');
        
        // Personal info
        const firstName = form.querySelector('[name="first_name"]').value || '-';
        const lastName = form.querySelector('[name="last_name"]').value || '-';
        document.getElementById('summaryName').textContent = firstName + ' ' + lastName;

        const gender = form.querySelector('[name="gender"]');
        document.getElementById('summaryGender').textContent = gender.value ? gender.options[gender.selectedIndex].text : '-';

        const civilStatus = form.querySelector('[name="civil_status"]');
        document.getElementById('summaryCivilStatus').textContent = civilStatus.value ? civilStatus.options[civilStatus.selectedIndex].text : '-';

        const contact = form.querySelector('[name="contact_number"]').value || '-';
        document.getElementById('summaryContact').textContent = contact;

        const region = form.querySelector('[name="region"]').value || '';
        const province = form.querySelector('[name="province"]').value || '';
        const city = form.querySelector('[name="city"]').value || '';
        const barangay = form.querySelector('[name="barangay"]').value || '';
        const address = [barangay, city, province, region].filter(Boolean).join(', ');
        document.getElementById('summaryAddress').textContent = address || '-';

        // Education
        let eduHtml = '';
        const eduContainer = document.getElementById('educationContainer');
        const eduCards = eduContainer.querySelectorAll('.entry-card');
        eduCards.forEach((card, index) => {
            const level = card.querySelector('[name$="[level]"]')?.value || '-';
            const school = card.querySelector('[name$="[school_name]"]')?.value || '-';
            const course = card.querySelector('[name$="[course]"]')?.value || '';
            const year = card.querySelector('[name$="[year_graduated]"]')?.value || '-';
            if (school) {
                eduHtml += `<div class="summary-item"><span class="summary-label">${level}</span><span class="summary-value">${school}${course ? ' - ' + course : ''} (${year})</span></div>`;
            }
        });
        document.getElementById('summaryEducation').innerHTML = eduHtml || '<div style="color: var(--color-muted);">No education added</div>';

        // Training
        let trainHtml = '';
        const trainContainer = document.getElementById('trainingContainer');
        const trainCards = trainContainer.querySelectorAll('.entry-card');
        trainCards.forEach((card, index) => {
            const title = card.querySelector('[name$="[training_title]"]')?.value || '-';
            const hours = card.querySelector('[name$="[training_hours]"]')?.value || '';
            const date = card.querySelector('[name$="[date_conducted]"]')?.value || '';
            if (title && title !== '-') {
                trainHtml += `<div class="summary-item"><span class="summary-label">Training</span><span class="summary-value">${title}${hours ? ' (' + hours + ' hours)' : ''}${date ? ' - ' + date : ''}</span></div>`;
            }
        });
        document.getElementById('summaryTraining').innerHTML = trainHtml || '<div style="color: var(--color-muted);">No training added</div>';

        // Experience
        let expHtml = '';
        const expContainer = document.getElementById('experienceContainer');
        const expCards = expContainer.querySelectorAll('.entry-card');
        expCards.forEach((card, index) => {
            const employer = card.querySelector('[name$="[employer]"]')?.value || '-';
            const position = card.querySelector('[name$="[position]"]')?.value || '';
            const startDate = card.querySelector('[name$="[start_date]"]')?.value || '';
            const endDate = card.querySelector('[name$="[end_date]"]')?.value || '';
            if (employer && employer !== '-') {
                expHtml += `<div class="summary-item"><span class="summary-label">${employer}</span><span class="summary-value">${position}${startDate ? ' (' + startDate + (endDate ? ' - ' + endDate : '') + ')' : ''}</span></div>`;
            }
        });
        document.getElementById('summaryExperience').innerHTML = expHtml || '<div style="color: var(--color-muted);">No experience added</div>';

        // Eligibility
        let eligHtml = '';
        const eligContainer = document.getElementById('eligibilityContainer');
        const eligCards = eligContainer.querySelectorAll('.entry-card');
        eligCards.forEach((card, index) => {
            const typeSelect = card.querySelector('[name$="[eligibility_type_id]"]');
            const type = typeSelect?.options[typeSelect.selectedIndex]?.text || '-';
            const license = card.querySelector('[name$="[license_no]"]')?.value || '';
            if (type && type !== '-') {
                eligHtml += `<div class="summary-item"><span class="summary-label">Eligibility</span><span class="summary-value">${type}${license ? ' - License: ' + license : ''}</span></div>`;
            }
        });
        document.getElementById('summaryEligibility').innerHTML = eligHtml || '<div style="color: var(--color-muted);">No eligibility added</div>';
    }

    document.getElementById('applicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCookie('XSRF-TOKEN') || csrfToken
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Application submitted successfully! Your application code is: ' + data.application_code);
                window.location.href = data.redirect || '/applicant/dashboard';
            } else {
                alert('Error: ' + (data.message || 'Something went wrong'));
            }
        })
        .catch(err => {
            // Fallback to regular form submission
            this.submit();
        });
    });

    updateStepDisplay();

    // Add/Remove entry functions
    let educationCount = 1;
    let trainingCount = 1;
    let experienceCount = 1;

    function addEducation() {
        const container = document.getElementById('educationContainer');
        const card = document.createElement('div');
        card.className = 'entry-card';
        card.dataset.index = educationCount;
        card.innerHTML = `
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Level</label>
                    <select name="educations[${educationCount}][level]" class="form-select">
                        <option value="Bachelors">Bachelors</option>
                        <option value="Masters">Masters</option>
                        <option value="Doctorate">Doctorate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">School Name</label>
                    <input type="text" name="educations[${educationCount}][school_name]" class="form-input">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Course</label>
                    <input type="text" name="educations[${educationCount}][course]" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Year Graduated</label>
                    <input type="number" name="educations[${educationCount}][year_graduated]" class="form-input" min="1900" max="2100">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Certificate (PDF/Image)</label>
                <input type="file" name="educations[${educationCount}][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <button type="button" class="btn-remove" onclick="removeEntry(this)">Remove</button>
        `;
        container.appendChild(card);
        educationCount++;
    }

    function addTraining() {
        const container = document.getElementById('trainingContainer');
        const card = document.createElement('div');
        card.className = 'entry-card';
        card.dataset.index = trainingCount;
        card.innerHTML = `
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Training Title</label>
                    <input type="text" name="trainings[${trainingCount}][training_title]" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Hours</label>
                    <input type="number" name="trainings[${trainingCount}][training_hours]" class="form-input">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Date Conducted</label>
                    <input type="date" name="trainings[${trainingCount}][date_conducted]" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Certificate (PDF/Image)</label>
                    <input type="file" name="trainings[${trainingCount}][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                </div>
            </div>
            <button type="button" class="btn-remove" onclick="removeEntry(this)">Remove</button>
        `;
        container.appendChild(card);
        trainingCount++;
    }

    function addExperience() {
        const container = document.getElementById('experienceContainer');
        const card = document.createElement('div');
        card.className = 'entry-card';
        card.dataset.index = experienceCount;
        card.innerHTML = `
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Employer</label>
                    <input type="text" name="experiences[${experienceCount}][employer]" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Position</label>
                    <input type="text" name="experiences[${experienceCount}][position]" class="form-input">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="experiences[${experienceCount}][start_date]" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" name="experiences[${experienceCount}][end_date]" class="form-input">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Sector</label>
                    <select name="experiences[${experienceCount}][sector]" class="form-select">
                        <option value="">Select</option>
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="NGO">NGO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Proof (PDF/Image)</label>
                    <input type="file" name="experiences[${experienceCount}][file]" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                </div>
            </div>
            <button type="button" class="btn-remove" onclick="removeEntry(this)">Remove</button>
        `;
        container.appendChild(card);
        experienceCount++;
    }

    function removeEntry(btn) {
        const container = btn.closest('.entry-card').parentElement;
        if (container.children.length > 1) {
            btn.closest('.entry-card').remove();
        }
    }

    // Make functions global
    window.nextStep = nextStep;
    window.prevStep = prevStep;
    window.addEducation = addEducation;
    window.addTraining = addTraining;
    window.addExperience = addExperience;
    window.removeEntry = removeEntry;
</script>