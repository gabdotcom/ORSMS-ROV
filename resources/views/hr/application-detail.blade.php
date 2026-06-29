@extends('layouts.hr')
@section('title', 'Application Details - DEPED Region V Recruitment')
@push('styles')
<style>
.badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
.modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
.modal-overlay.show { display: flex; }
.modal-content { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto; }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.modal-title { font-size: 18px; font-weight: 600; }
.modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: var(--color-body); }
.email-modal .modal-content { max-width: 800px; }

@media (max-width: 768px) { .modal-content { width: 95%; padding: 16px; } }
</style>
@endpush
@section('content')
<div class="mb-lg flex items-start justify-between flex-wrap gap-base">
    <div>
        <div class="mb-2">
            <a href="{{ route('hr.applications') }}" class="text-primary no-underline text-sm inline-flex items-center gap-1 hover:underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"></path><polyline points="12 19 5 12 12 5"></polyline></svg>
                Back to Applications
            </a>
        </div>
        <h1 class="text-2xl font-semibold mb-1">Application: {{ $application->application_code }}</h1>
        <p class="text-sm text-body">
            {{ $application->user->first_name ?? '-' }} {{ $application->user->last_name ?? '-' }} &middot;
            {{ $application->job->plantillaPosition->position_name ?? '-' }}
        </p>
    </div>
    <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background: var(--color-status-{{ $application->status }}-bg); color: var(--color-status-{{ $application->status }}-text);">{{ ucfirst($application->status) }}</span>
</div>

@if(session('success'))<script>showToast('{{ session('success') }}')</script>@endif

@if(session('error'))<script>showToast('{{ session('error') }}',true)</script>@endif

<div class="grid grid-cols-2 gap-lg mb-lg max-md:grid-cols-1">

    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Personal Information</h2>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Name</span><span class="text-sm">{{ $application->user->first_name ?? '-' }} {{ $application->user->middle_name ?? '' }} {{ $application->user->last_name ?? '' }} {{ $application->user->extension_name ?? '' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Email</span><span class="text-sm">{{ $application->user->email ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Submitted</span><span class="text-sm">{{ $application->created_at->format('M d, Y h:i A') }}</span></div>
        @if($application->reviewed_at)
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Reviewed</span><span class="text-sm">{{ $application->reviewed_at->format('M d, Y h:i A') }}</span></div>
        @endif
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Job Information</h2>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Position</span><span class="text-sm">{{ $application->job->plantillaPosition->position_name ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Department</span><span class="text-sm">{{ $application->job->plantillaPosition->department ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Item No.</span><span class="text-sm">{{ $application->job->plantillaPosition->plantilla_item_no ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-hairline last:border-none"><span class="w-[150px] text-muted text-[13px] shrink-0">Salary Grade</span><span class="text-sm">SG-{{ $application->job->plantillaPosition->salary_grade ?? '-' }}</span></div>
    </div>

    @if($application->educations->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Education</h2>
        @foreach($application->educations as $edu)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $edu->level }}</div>
            <div class="text-[13px] text-body">{{ $edu->school_name }}{{ $edu->course ? ' - ' . $edu->course : '' }} ({{ $edu->year_graduated }})</div>
        </div>
        @endforeach
    </div>
    @endif

    @if($application->experiences->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Work Experience</h2>
        @foreach($application->experiences as $exp)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $exp->position }} at {{ $exp->employer }}</div>
            <div class="text-[13px] text-body">
                {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }} -
                {{ $exp->is_present ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '') }}
                {{ $exp->sector ? ' | ' . $exp->sector : '' }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($application->trainings->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Training</h2>
        @foreach($application->trainings as $train)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $train->training_title }}</div>
            <div class="text-[13px] text-body">
                {{ $train->training_hours ? $train->training_hours . ' hours' : '' }}
                {{ $train->date_conducted ? ' | ' . \Carbon\Carbon::parse($train->date_conducted)->format('M d, Y') : '' }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($application->eligibilities->count() > 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-lg">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Eligibility</h2>
        @foreach($application->eligibilities as $elig)
        <div class="p-3 bg-canvas-soft rounded-md mb-3 last:mb-0">
            <div class="font-medium text-sm mb-1">{{ $elig->eligibilityType->name ?? 'Other' }}</div>
            <div class="text-[13px] text-body">
                {{ $elig->license_no ? 'License: ' . $elig->license_no : '' }}
                {{ $elig->date_issued ? ' | Issued: ' . \Carbon\Carbon::parse($elig->date_issued)->format('M d, Y') : '' }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @php
    $sectors = ['education', 'training', 'experience', 'eligibility'];
    $sectorEvals = $application->sectorEvaluations->keyBy('sector');
    $allQualified = $sectorEvals->every(fn($e) => $e->status === 'qualified');
    $anyDisqualified = $sectorEvals->contains(fn($e) => $e->status === 'disqualified');
    @endphp

    <div class="bg-surface-card border border-hairline rounded-lg p-lg col-span-2 max-md:col-span-1">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Sector Evaluations</h2>
        <div class="grid grid-cols-4 gap-3 mb-4 max-md:grid-cols-2">
            @foreach($sectors as $sector)
            <div class="p-3 border border-hairline rounded-md text-center cursor-pointer hover:border-primary transition-all" onclick="openSectorModal('{{ $sector }}')">
                <div class="text-xs text-muted uppercase mb-1">{{ ucfirst($sector) }}</div>
                <div class="text-sm font-semibold" style="color: {{ $sectorEvals[$sector]?->status === 'qualified' ? '#16a34a' : ($sectorEvals[$sector]?->status === 'disqualified' ? '#dc2626' : '#ab6400') }}">
                    {{ ucfirst($sectorEvals[$sector]->status ?? 'pending') }}
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors" onclick="openSectorModal()">Evaluate Sectors</button>
    </div>

    <div class="bg-surface-card border border-hairline rounded-lg p-lg col-span-2 max-md:col-span-1">
        <h2 class="text-base font-semibold pb-3 border-b border-hairline mb-4">Update Application Status</h2>
        @if($anyDisqualified)
        <div class="bg-[#fef3c7] border border-[#f59e0b] rounded-md p-3 text-xs text-[#92400e] mb-4">
            <strong>Note:</strong> This application has one or more disqualified sectors. The general status cannot be set to "Qualified".
        </div>
        @elseif(!$allQualified && $application->status !== 'pending')
        <div class="bg-[#fef3c7] border border-[#f59e0b] rounded-md p-3 text-xs text-[#92400e] mb-4">
            <strong>Note:</strong> All sectors must be "Qualified" before you can set this application as "Qualified".
        </div>
        @endif
        <form method="POST" action="{{ route('hr.applications.update-status', $application->id) }}" id="statusForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="email_body" id="emailBodyInput">
            <input type="hidden" name="email_subject" id="emailSubjectInput">
            <div class="grid grid-cols-2 gap-4 mb-4 max-md:grid-cols-1">
                <div class="mb-4">
                    <label class="block text-[13px] font-medium mb-[6px]">Status</label>
                    <select name="status" id="statusSelect" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" required {{ $anyDisqualified ? 'disabled' : '' }}>
                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="qualified" {{ $application->status === 'qualified' ? 'selected' : '' }} {{ $anyDisqualified || !$allQualified ? 'disabled' : '' }}>Qualified</option>
                        <option value="disqualified" {{ $application->status === 'disqualified' ? 'selected' : '' }}>Disqualified</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-[13px] font-medium mb-[6px]">Notes (Optional)</label>
                    <textarea name="hr_notes" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans resize-vertical" style="min-height:100px;" placeholder="Add notes about this application...">{{ $application->hr_notes ?? '' }}</textarea>
                </div>
            </div>
            <button type="button" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors" onclick="previewEmail()" {{ $anyDisqualified ? 'disabled' : '' }}>Update Status</button>
        </form>
    </div>
</div>

<!-- Sector Evaluation Modal -->
<div class="modal-overlay" id="sectorModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Evaluate Sectors</h3>
            <button class="modal-close" onclick="closeSectorModal()">&times;</button>
        </div>
        <form method="POST" action="{{ route('hr.applications.sector-evaluation', $application->id) }}">
            @csrf
            @method('PUT')
            @foreach($sectors as $sector)
            @php $eval = $sectorEvals[$sector] ?? null; @endphp
            <div class="p-4 border border-hairline rounded-md mb-4 last:mb-0" id="sector-form-{{ $sector }}">
                <div class="text-sm font-semibold mb-3 flex items-center gap-2">
                    {{ ucfirst($sector) }}
                    @if($eval)
                    <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background: var(--color-status-{{ $eval->status }}-bg); color: var(--color-status-{{ $eval->status }}-text);">{{ $eval->status }}</span>
                    @endif
                </div>
                <div class="flex gap-4 mb-3">
                    <label class="flex items-center gap-[6px] text-sm cursor-pointer">
                        <input type="radio" name="sectors[{{ $sector }}][status]" value="qualified" {{ $eval?->status === 'qualified' ? 'checked' : '' }}> Qualified
                    </label>
                    <label class="flex items-center gap-[6px] text-sm cursor-pointer">
                        <input type="radio" name="sectors[{{ $sector }}][status]" value="disqualified" {{ $eval?->status === 'disqualified' ? 'checked' : '' }}> Disqualified
                    </label>
                    <label class="flex items-center gap-[6px] text-sm cursor-pointer">
                        <input type="radio" name="sectors[{{ $sector }}][status]" value="pending" {{ !$eval || $eval->status === 'pending' ? 'checked' : '' }}> Pending
                    </label>
                </div>
                <textarea name="sectors[{{ $sector }}][remarks]" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans resize-vertical" style="min-height:100px;" placeholder="Remarks for {{ $sector }}...">{{ $eval?->remarks ?? '' }}</textarea>
            </div>
            @endforeach
            <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors w-full mt-4">Save Evaluations</button>
        </form>
    </div>
</div>

<!-- Email Preview Modal -->
<div class="modal-overlay email-modal" id="emailPreviewModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Compose Email</h3>
            <button class="modal-close" onclick="closeEmailModal()">&times;</button>
        </div>
        <div style="font-size:13px;color:var(--color-muted);margin-bottom:16px;">
            This email will be sent to <strong id="emailRecipient">{{ $application->user->email }}</strong>
        </div>
        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Subject</label>
            <input type="text" id="emailSubject" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" style="width:100%;">
        </div>
        <div style="margin-bottom:12px;">
            <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">
                Email Body
                <button type="button" id="previewToggleBtn" class="bg-surface-card text-ink text-xs font-medium px-3 py-1 border border-hairline-strong rounded-md cursor-pointer inline-flex items-center gap-1 hover:bg-surface-strong transition-colors" style="margin-left:10px;vertical-align:middle;" onclick="showPreview()">Show Preview</button>
            </label>
            <textarea id="emailBodySource" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans resize-vertical" style="min-height:350px;width:100%;font-size:13px;line-height:1.6;"></textarea>
        </div>
        <div style="display:flex;gap:10px;justify-content:center;border-top:1px solid var(--color-hairline);padding-top:16px;margin-top:16px;">
            <button type="button" class="bg-[#e5e7eb] text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-[#d1d5db] transition-colors" onclick="closeEmailModal()">Cancel</button>
            <button type="button" id="sendEmailBtn" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors" onclick="sendEmail()">Send Email &amp; Update Status</button>
        </div>
    </div>
</div>

<!-- Full Preview Modal -->
<div class="modal-overlay" id="previewModal" style="z-index:2200;">
    <div class="bg-white rounded-lg max-w-[900px] mx-auto my-5 max-h-[calc(100vh-40px)] overflow-y-auto" style="cursor:default;width:95%;" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between px-lg py-5 border-b border-hairline sticky top-0 bg-white z-[1]">
            <h2 class="text-xl font-semibold">Email Preview</h2>
            <button class="bg-none border-none text-[28px] cursor-pointer text-body leading-none hover:text-ink transition-colors" onclick="closePreviewModal()">&times;</button>
        </div>
        <div class="p-lg">
            <iframe id="previewIframe" style="width:100%;height:80vh;border:none;"></iframe>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openSectorModal() { document.getElementById('sectorModal').classList.add('show'); }
function closeSectorModal() { document.getElementById('sectorModal').classList.remove('show'); }
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeSectorModal(); closeEmailModal(); closePreviewModal(); } });
document.getElementById('sectorModal')?.addEventListener('click', function(e) { if (e.target === this) closeSectorModal(); });
document.getElementById('emailPreviewModal')?.addEventListener('click', function(e) { if (e.target === this) closeEmailModal(); });
document.getElementById('previewModal')?.addEventListener('click', function(e) { if (e.target === this) closePreviewModal(); });

function extractBody(fullText) {
    const match = fullText.match(/ELIGIBILITY\n(?:  [^\n]*\n)*\n([\s\S]+?)\n\nVery truly yours,/);
    if (match) return match[1].trim();
    const idx = fullText.lastIndexOf('\n\nVery truly yours,');
    if (idx === -1) return fullText;
    return fullText.substring(0, idx).trim();
}

function closeEmailModal() {
    document.getElementById('emailPreviewModal').classList.remove('show');
    document.getElementById('previewToggleBtn').innerHTML = 'Show Preview';
}

function previewEmail() {
    const status = document.getElementById('statusSelect').value;
    if (status === 'pending') {
        showToast('Please select Qualified or Disqualified to send an email.', true);
        return;
    }
    const btn = document.querySelector('[onclick="previewEmail()"]');
    btn.disabled = true;
    btn.textContent = 'Loading...';
    fetch('{{ route("hr.applications.email-preview", $application->id) }}?status=' + encodeURIComponent(status))
        .then(function(r) {
            if (!r.ok) { return r.json().then(function(d) { throw new Error(d.error || 'Server error'); }); }
            return r.json();
        })
        .then(function(data) {
            document.getElementById('emailSubject').value = data.subject;
            document.getElementById('emailBodySource').value = data.text;
            document.getElementById('previewToggleBtn').innerHTML = 'Show Preview';
            document.getElementById('emailPreviewModal').classList.add('show');
            btn.disabled = false;
            btn.textContent = 'Update Status';
        })
        .catch(function(err) {
            console.error('Email preview error:', err);
            showToast('Failed to load email preview: ' + err.message, true);
            btn.disabled = false;
            btn.textContent = 'Update Status';
        });
}

function showPreview() {
    const btn = document.getElementById('previewToggleBtn');
    const status = document.getElementById('statusSelect').value;
    const body = extractBody(document.getElementById('emailBodySource').value);
    btn.disabled = true;
    btn.textContent = 'Building preview...';
    fetch('{{ route("hr.applications.build-email", $application->id) }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '', 'Accept': 'application/json' },
        body: JSON.stringify({ status: status, body_text: body })
    })
        .then(function(r) {
            if (!r.ok) { return r.json().then(function(d) { throw new Error(d.error || 'Failed to build email'); }); }
            return r.json();
        })
        .then(function(data) {
            document.getElementById('previewIframe').srcdoc = data.html;
            document.getElementById('previewModal').classList.add('show');
            btn.disabled = false;
            btn.innerHTML = 'Show Preview';
        })
        .catch(function(err) {
            console.error('Build email error:', err);
            showToast('Failed to build email preview: ' + err.message, true);
            btn.disabled = false;
            btn.innerHTML = 'Show Preview';
        });
}

function closePreviewModal() {
    document.getElementById('previewModal').classList.remove('show');
}

function sendEmail() {
    const sendBtn = document.getElementById('sendEmailBtn');
    const status = document.getElementById('statusSelect').value;
    const body = extractBody(document.getElementById('emailBodySource').value);
    const subject = document.getElementById('emailSubject').value;
    sendBtn.disabled = true;
    sendBtn.textContent = 'Sending...';
    fetch('{{ route("hr.applications.build-email", $application->id) }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '', 'Accept': 'application/json' },
        body: JSON.stringify({ status: status, body_text: body })
    })
        .then(function(r) {
            if (!r.ok) { return r.json().then(function(d) { throw new Error(d.error || 'Failed to build email'); }); }
            return r.json();
        })
        .then(function(data) {
            document.getElementById('emailBodyInput').value = data.html;
            document.getElementById('emailSubjectInput').value = subject;
            document.getElementById('statusForm').submit();
        })
        .catch(function(err) {
            console.error('Send email error:', err);
            showToast('Failed to send email: ' + err.message, true);
            sendBtn.disabled = false;
            sendBtn.textContent = 'Send Email & Update Status';
        });
}
</script>
@endpush