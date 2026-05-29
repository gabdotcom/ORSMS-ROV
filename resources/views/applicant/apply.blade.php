@extends('layouts.applicant')
@section('title', 'Apply for Position - DEPED Region V Recruitment')
@push('styles')
<style>
.required { color: #dc2626; }
</style>
@endpush
@section('content')
<div class="mb-lg">
    <div class="mb-2">
        <a href="{{ route('applicant.jobs') }}" class="text-primary no-underline text-sm inline-flex items-center gap-1 hover:underline">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"></path><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Jobs
        </a>
    </div>
    <h1 class="text-2xl font-semibold mb-1">Apply for Position</h1>
    <p class="text-sm text-body">Complete the form below to submit your application</p>
</div>

<div class="bg-canvas-soft rounded-md p-4 mb-lg">
    <h3 class="text-base font-semibold mb-1">{{ $jobPosting->plantillaPosition->position_name ?? 'Position' }}</h3>
    <p class="text-sm text-body">{{ $jobPosting->plantillaPosition->department ?? 'Department' }} | SG-{{ $jobPosting->plantillaPosition->salary_grade ?? '-' }}</p>
</div>

<form method="POST" action="{{ route('applicant.store-application', $jobPosting->id) }}" enctype="multipart/form-data">
    @csrf

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Personal Information</h2>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">First Name <span class="required">*</span></label><input type="text" name="first_name" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->first_name }}" required></div>
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Last Name <span class="required">*</span></label><input type="text" name="last_name" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->last_name }}" required></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Middle Name</label><input type="text" name="middle_name" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->middle_name }}"></div>
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Extension Name</label><input type="text" name="extension_name" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->extension_name }}"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Date of Birth</label><input type="date" name="date_of_birth" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '' }}"></div>
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Gender</label>
                <select name="gender" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                    <option value="">Select</option>
                    <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Civil Status</label>
                <select name="civil_status" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                    <option value="">Select</option>
                    @foreach(['Single','Married','Widowed','Separated','Annulled'] as $cs)
                    <option value="{{ $cs }}" {{ ($profile->civil_status ?? '') == $cs ? 'selected' : '' }}>{{ $cs }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Citizenship</label><input type="text" name="citizenship" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->citizenship ?? '' }}"></div>
        </div>
        <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Contact Number</label><input type="text" name="contact_number" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->contact_number ?? '' }}"></div>
        <div class="grid grid-cols-3 gap-4 mt-2">
            <label class="checkbox-group text-sm flex items-center gap-2"><input type="checkbox" name="is_person_with_disability" value="1" {{ ($profile->is_person_with_disability ?? false) ? 'checked' : '' }}> Person with Disability (PWD)</label>
            <label class="checkbox-group text-sm flex items-center gap-2"><input type="checkbox" name="is_solo_parent" value="1" {{ ($profile->is_solo_parent ?? false) ? 'checked' : '' }}> Solo Parent</label>
            <label class="checkbox-group text-sm flex items-center gap-2"><input type="checkbox" name="is_member_of_indigenous_people" value="1" {{ ($profile->is_member_of_indigenous_people ?? false) ? 'checked' : '' }}> Member of Indigenous People</label>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Address</h2>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Region</label><input type="text" name="region" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->region ?? '' }}"></div>
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Province</label><input type="text" name="province" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->province ?? '' }}"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">City/Municipality</label><input type="text" name="city" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->city ?? '' }}"></div>
            <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Barangay</label><input type="text" name="barangay" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->barangay ?? '' }}"></div>
        </div>
        <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Zip Code</label><input type="text" name="zip_code" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->zip_code ?? '' }}"></div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Education</h2>
        <div id="educationContainer">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Level</label>
                        <select name="educations[0][level]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            <option value="Bachelors">Bachelors</option><option value="Masters">Masters</option><option value="Doctorate">Doctorate</option>
                        </select>
                    </div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">School Name</label><input type="text" name="educations[0][school_name]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Course</label><input type="text" name="educations[0][course]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Year Graduated</label><input type="number" name="educations[0][year_graduated]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" min="1900" max="2100"></div>
                </div>
                <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Certificate (PDF/Image)</label><input type="file" name="educations[0][file]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png"></div>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Training</h2>
        <div id="trainingContainer">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Training Title</label><input type="text" name="trainings[0][training_title]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Hours</label><input type="number" name="trainings[0][training_hours]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Date Conducted</label><input type="date" name="trainings[0][date_conducted]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Certificate (PDF/Image)</label><input type="file" name="trainings[0][file]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Work Experience</h2>
        <div id="experienceContainer">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Employer</label><input type="text" name="experiences[0][employer]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Position</label><input type="text" name="experiences[0][position]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Start Date</label><input type="date" name="experiences[0][start_date]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">End Date</label><input type="date" name="experiences[0][end_date]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Sector</label>
                        <select name="experiences[0][sector]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            <option value="">Select</option><option value="Government">Government</option><option value="Private">Private</option><option value="NGO">NGO</option>
                        </select>
                    </div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Proof (PDF/Image)</label><input type="file" name="experiences[0][file]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Eligibility</h2>
        <div id="eligibilityContainer">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Eligibility Type</label>
                        <select name="eligibilities[0][eligibility_type_id]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            <option value="">Select</option>
                            @foreach($eligibilityTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">License Number</label><input type="text" name="eligibilities[0][license_no]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Date Issued</label><input type="date" name="eligibilities[0][date_issued]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Certificate (PDF/Image)</label><input type="file" name="eligibilities[0][file]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png"></div>
                </div>
            </div>
        </div>
    </div>

    @if($documentTypes->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Additional Documents</h2>
        @foreach($documentTypes as $doc)
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">{{ $doc->name }} {{ $doc->is_required ? '*' : '' }}</label>
                <input type="file" name="documents[{{ $doc->id }}][file]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png" {{ $doc->is_required ? 'required' : '' }}>
            </div>
        @endforeach
    </div>
    @endif

    <div class="flex gap-3 justify-end mt-lg">
        <a href="{{ route('applicant.jobs') }}" class="bg-surface-card text-ink text-sm font-medium px-4 py-2 border border-hairline-strong rounded-md cursor-pointer h-9 inline-flex items-center gap-[6px] hover:bg-surface-strong transition-colors no-underline">Cancel</a>
        <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors">Submit Application</button>
    </div>
</form>
@endsection
