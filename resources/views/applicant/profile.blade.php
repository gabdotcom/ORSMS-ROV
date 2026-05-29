@extends('layouts.applicant')
@section('title', 'Profile - DEPED Region V Recruitment')
@push('styles')
<style>
.checkbox-group { display: flex; gap: 8px; align-items: center; }
.checkbox-group input { width: auto; }
</style>
@endpush
@section('content')
<div class="mb-lg">
    <h1 class="text-2xl font-semibold mb-1">My Profile</h1>
    <p class="text-sm text-body">Manage your personal information</p>
</div>

@if(session('success'))<script>showToast('{{ session('success') }}')</script>@endif

@if(session('error'))<script>showToast('{{ session('error') }}',true)</script>@endif

<form method="POST" action="{{ route('applicant.update-profile') }}">
    @csrf

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Account Information</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">First Name</label>
                <input type="text" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->first_name }}" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Last Name</label>
                <input type="text" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->last_name }}" disabled>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Email</label>
                <input type="email" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ auth()->user()->email }}" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Role</label>
                <input type="text" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="Applicant" disabled>
            </div>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Personal Details</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Date of Birth</label>
                <input type="date" name="date_of_birth" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '' }}">
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Gender</label>
                <select name="gender" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                    <option value="">Select</option>
                    <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Civil Status</label>
                <select name="civil_status" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans bg-white">
                    <option value="">Select</option>
                    <option value="Single" {{ ($profile->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Married" {{ ($profile->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                    <option value="Widowed" {{ ($profile->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    <option value="Separated" {{ ($profile->civil_status ?? '') == 'Separated' ? 'selected' : '' }}>Separated</option>
                    <option value="Annulled" {{ ($profile->civil_status ?? '') == 'Annulled' ? 'selected' : '' }}>Annulled</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Citizenship</label>
                <input type="text" name="citizenship" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->citizenship ?? '' }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Religion</label>
                <input type="text" name="religion" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->religion ?? '' }}">
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Contact Number</label>
                <input type="text" name="contact_number" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->contact_number ?? '' }}">
            </div>
        </div>
        <div class="mt-4 space-y-3">
            <label class="checkbox-group text-sm">
                <input type="checkbox" name="is_person_with_disability" value="1" {{ ($profile->is_person_with_disability ?? false) ? 'checked' : '' }}>
                <span>Person with Disability (PWD)</span>
            </label>
            <label class="checkbox-group text-sm">
                <input type="checkbox" name="is_solo_parent" value="1" {{ ($profile->is_solo_parent ?? false) ? 'checked' : '' }}>
                <span>Solo Parent</span>
            </label>
            <label class="checkbox-group text-sm">
                <input type="checkbox" name="is_member_of_indigenous_people" value="1" {{ ($profile->is_member_of_indigenous_people ?? false) ? 'checked' : '' }}>
                <span>Member of Indigenous People</span>
            </label>
        </div>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg mb-lg">
        <h2 class="text-base font-semibold mb-5">Address</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Region</label>
                <input type="text" name="region" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->region ?? '' }}">
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Province</label>
                <input type="text" name="province" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->province ?? '' }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">City/Municipality</label>
                <input type="text" name="city" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->city ?? '' }}">
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Barangay</label>
                <input type="text" name="barangay" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->barangay ?? '' }}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Zip Code</label>
                <input type="text" name="zip_code" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" value="{{ $profile->zip_code ?? '' }}">
            </div>
            <div class="mb-4">
                <label class="block text-[13px] font-medium mb-[6px]">Current Address</label>
                <textarea name="current_address" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans resize-vertical" style="min-height:80px;">{{ $profile->current_address ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors">Save Changes</button>
</form>
@endsection