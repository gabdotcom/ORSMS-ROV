@extends('layouts.applicant')
@section('title', 'Edit Application - DEPED Region V Recruitment')
@push('styles')
<style>
@media (max-width: 768px) { .entry-grid { grid-template-columns: 1fr; } }
</style>
@endpush
@section('content')
@if(session('success'))<script>showToast('{{ session('success') }}')</script>@endif

@if(session('error'))<script>showToast('{{ session('error') }}',true)</script>@endif

<div class="mb-lg">
    <h1 class="text-2xl font-semibold mb-1">Edit Application: {{ $application->application_code }}</h1>
    <p class="text-sm text-body">{{ $application->job->plantillaPosition->position_name ?? '-' }}</p>
</div>

<form method="POST" action="{{ route('applicant.update-application', $application->id) }}">
    @csrf
    @method('PUT')

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold">Education</h2>
            <button type="button" class="bg-primary text-white text-sm font-medium px-3 py-1 border-none rounded-md cursor-pointer h-[30px] hover:bg-primary-active transition-colors" onclick="addEducation()">+ Add Education</button>
        </div>
        <div id="education-entries">
            @foreach($application->educations as $edu)
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft" data-id="{{ $edu->id }}">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">Education Entry</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="deleteEntry('education', {{ $edu->id }})">Delete</button>
                </div>
                <input type="hidden" name="educations[{{ $loop->index }}][id]" value="{{ $edu->id }}">
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Level</label>
                        <select name="educations[{{ $loop->index }}][level]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            <option value="Elementary" {{ $edu->level == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                            <option value="High School" {{ $edu->level == 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Senior High School" {{ $edu->level == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                            <option value="Bachelors" {{ $edu->level == 'Bachelors' ? 'selected' : '' }}>Bachelors</option>
                            <option value="Masters" {{ $edu->level == 'Masters' ? 'selected' : '' }}>Masters</option>
                            <option value="Doctorate" {{ $edu->level == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Year Graduated</label>
                        <input type="number" name="educations[{{ $loop->index }}][year_graduated]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $edu->year_graduated }}" min="1900" max="2099">
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block text-[13px] font-medium mb-[6px]">School Name</label>
                        <input type="text" name="educations[{{ $loop->index }}][school_name]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $edu->school_name }}" required>
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block text-[13px] font-medium mb-[6px]">Course (Optional)</label>
                        <input type="text" name="educations[{{ $loop->index }}][course]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $edu->course }}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="education-template" class="hidden">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft new-entry">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">New Education</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="this.closest('.new-entry').remove()">Delete</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Level</label>
                        <select name="educations[__INDEX__][level]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="Senior High School">Senior High School</option>
                            <option value="Bachelors">Bachelors</option>
                            <option value="Masters">Masters</option>
                            <option value="Doctorate">Doctorate</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Year Graduated</label>
                        <input type="number" name="educations[__INDEX__][year_graduated]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" min="1900" max="2099">
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block text-[13px] font-medium mb-[6px]">School Name</label>
                        <input type="text" name="educations[__INDEX__][school_name]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" required>
                    </div>
                    <div class="mb-4 col-span-2">
                        <label class="block text-[13px] font-medium mb-[6px]">Course (Optional)</label>
                        <input type="text" name="educations[__INDEX__][course]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold">Training</h2>
            <button type="button" class="bg-primary text-white text-sm font-medium px-3 py-1 border-none rounded-md cursor-pointer h-[30px] hover:bg-primary-active transition-colors" onclick="addTraining()">+ Add Training</button>
        </div>
        <div id="training-entries">
            @foreach($application->trainings as $train)
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft" data-id="{{ $train->id }}">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">Training Entry</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="deleteEntry('training', {{ $train->id }})">Delete</button>
                </div>
                <input type="hidden" name="trainings[{{ $loop->index }}][id]" value="{{ $train->id }}">
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4 col-span-2">
                        <label class="block text-[13px] font-medium mb-[6px]">Training Title</label>
                        <input type="text" name="trainings[{{ $loop->index }}][training_title]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $train->training_title }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Training Hours</label>
                        <input type="number" name="trainings[{{ $loop->index }}][training_hours]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $train->training_hours }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Date Conducted</label>
                        <input type="date" name="trainings[{{ $loop->index }}][date_conducted]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $train->date_conducted?->format('Y-m-d') }}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="training-template" class="hidden">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft new-entry">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">New Training</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="this.closest('.new-entry').remove()">Delete</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4 col-span-2">
                        <label class="block text-[13px] font-medium mb-[6px]">Training Title</label>
                        <input type="text" name="trainings[__INDEX__][training_title]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Training Hours</label>
                        <input type="number" name="trainings[__INDEX__][training_hours]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans">
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Date Conducted</label>
                        <input type="date" name="trainings[__INDEX__][date_conducted]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold">Work Experience</h2>
            <button type="button" class="bg-primary text-white text-sm font-medium px-3 py-1 border-none rounded-md cursor-pointer h-[30px] hover:bg-primary-active transition-colors" onclick="addExperience()">+ Add Experience</button>
        </div>
        <div id="experience-entries">
            @foreach($application->experiences as $exp)
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft" data-id="{{ $exp->id }}">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">Experience Entry</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="deleteEntry('experience', {{ $exp->id }})">Delete</button>
                </div>
                <input type="hidden" name="experiences[{{ $loop->index }}][id]" value="{{ $exp->id }}">
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Position</label>
                        <input type="text" name="experiences[{{ $loop->index }}][position]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $exp->position }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Employer</label>
                        <input type="text" name="experiences[{{ $loop->index }}][employer]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $exp->employer }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Start Date</label>
                        <input type="date" name="experiences[{{ $loop->index }}][start_date]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $exp->start_date?->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">End Date</label>
                        <input type="date" name="experiences[{{ $loop->index }}][end_date]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $exp->end_date?->format('Y-m-d') }}" {{ $exp->is_present ? 'disabled' : '' }}>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="experiences[{{ $loop->index }}][is_present]" value="1" {{ $exp->is_present ? 'checked' : '' }} onchange="toggleEndDate(this)"> Currently Working
                        </label>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Sector</label>
                        <select name="experiences[{{ $loop->index }}][sector]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
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
        <div id="experience-template" class="hidden">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft new-entry">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">New Experience</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="this.closest('.new-entry').remove()">Delete</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Position</label><input type="text" name="experiences[__INDEX__][position]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" required></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Employer</label><input type="text" name="experiences[__INDEX__][employer]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" required></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Start Date</label><input type="date" name="experiences[__INDEX__][start_date]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" required></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">End Date</label><input type="date" name="experiences[__INDEX__][end_date]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans"></div>
                    <div class="mb-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="experiences[__INDEX__][is_present]" value="1" onchange="toggleEndDate(this)"> Currently Working</label></div>
                    <div class="mb-4"><label class="block text-[13px] font-medium mb-[6px]">Sector</label>
                        <select name="experiences[__INDEX__][sector]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            <option value="">Select Sector</option>
                            <option value="Government">Government</option><option value="Private">Private</option><option value="Academic">Academic</option><option value="NGO">NGO</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold">Eligibility</h2>
            <button type="button" class="bg-primary text-white text-sm font-medium px-3 py-1 border-none rounded-md cursor-pointer h-[30px] hover:bg-primary-active transition-colors" onclick="addEligibility()">+ Add Eligibility</button>
        </div>
        <div id="eligibility-entries">
            @foreach($application->eligibilities as $elig)
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft" data-id="{{ $elig->id }}">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">Eligibility Entry</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="deleteEntry('eligibility', {{ $elig->id }})">Delete</button>
                </div>
                <input type="hidden" name="eligibilities[{{ $loop->index }}][id]" value="{{ $elig->id }}">
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Eligibility Type</label>
                        <select name="eligibilities[{{ $loop->index }}][eligibility_type_id]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            @foreach(App\Models\EligibilityType::where('is_active', true)->get() as $type)
                            <option value="{{ $type->id }}" {{ $elig->eligibility_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">License Number (Optional)</label>
                        <input type="text" name="eligibilities[{{ $loop->index }}][license_no]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $elig->license_no }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Date Issued (Optional)</label>
                        <input type="date" name="eligibilities[{{ $loop->index }}][date_issued]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $elig->date_issued?->format('Y-m-d') }}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="eligibility-template" class="hidden">
            <div class="border border-hairline rounded-md p-4 mb-3 bg-canvas-soft new-entry">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-medium text-sm">New Eligibility</span>
                    <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca]" onclick="this.closest('.new-entry').remove()">Delete</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Eligibility Type</label>
                        <select name="eligibilities[__INDEX__][eligibility_type_id]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                            @foreach(App\Models\EligibilityType::where('is_active', true)->get() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">License Number (Optional)</label>
                        <input type="text" name="eligibilities[__INDEX__][license_no]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans">
                    </div>
                    <div class="mb-4">
                        <label class="block text-[13px] font-medium mb-[6px]">Date Issued (Optional)</label>
                        <input type="date" name="eligibilities[__INDEX__][date_issued]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-10">
        <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors">Save Changes</button>
        <a href="{{ route('applicant.view-application', $application->id) }}" class="bg-surface-card text-ink text-sm font-medium px-4 py-2 border border-hairline-strong rounded-md cursor-pointer h-9 inline-flex items-center gap-[6px] hover:bg-surface-strong transition-colors no-underline ml-3">Cancel</a>
    </div>
</form>

@push('scripts')
<script>
    let eduCount = {{ $application->educations->count() }};
    let trainCount = {{ $application->trainings->count() }};
    let expCount = {{ $application->experiences->count() }};
    let eligCount = {{ $application->eligibilities->count() }};

    function addEducation() { const t = document.getElementById('education-template').innerHTML.replace(/__INDEX__/g, eduCount++); document.getElementById('education-entries').insertAdjacentHTML('beforeend', t); }
    function addTraining() { const t = document.getElementById('training-template').innerHTML.replace(/__INDEX__/g, trainCount++); document.getElementById('training-entries').insertAdjacentHTML('beforeend', t); }
    function addExperience() { const t = document.getElementById('experience-template').innerHTML.replace(/__INDEX__/g, expCount++); document.getElementById('experience-entries').insertAdjacentHTML('beforeend', t); }
    function addEligibility() { const t = document.getElementById('eligibility-template').innerHTML.replace(/__INDEX__/g, eligCount++); document.getElementById('eligibility-entries').insertAdjacentHTML('beforeend', t); }

    function toggleEndDate(checkbox) {
        const endDateInput = checkbox.closest('.grid').querySelector('input[name*="end_date"]');
        if (endDateInput) { endDateInput.disabled = checkbox.checked; if (checkbox.checked) endDateInput.value = ''; }
    }

    async function deleteEntry(type, id) {
        if (!confirm('Are you sure you want to delete this entry?')) return;
        try {
            const r = await fetch('{{ route("applicant.delete-entry", $application->id) }}', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify({ type, id })
            });
            const d = await r.json();
            if (d.success) document.querySelector(`[data-id="${id}"]`).remove();
            else showToast(d.error || 'Error deleting entry', true);
        } catch(e) { showToast('Error deleting entry', true); }
    }
</script>
@endpush
@endsection