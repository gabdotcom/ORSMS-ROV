@extends('layouts.applicant')
@section('title', 'Dashboard - DEPED Region V Recruitment')
@push('styles')
<style>
.modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 2000; padding: 20px; overflow-y: auto; cursor: pointer; }
.modal-overlay.show { display: block; }
.modal-content { background: white; border-radius: var(--rounded-lg); max-width: 900px; margin: 20px auto; max-height: calc(100vh - 40px); overflow-y: auto; cursor: default; }
.modal-header { padding: 20px 24px; border-bottom: 1px solid var(--color-hairline); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: white; z-index: 1; }
.modal-title { font-size: 20px; font-weight: 600; }
.modal-close { background: none; border: none; font-size: 28px; cursor: pointer; color: var(--color-body); line-height: 1; }
.modal-close:hover { color: var(--color-ink); }
.modal-body { padding: 24px; }
.modal-footer { padding: 16px 24px; border-top: 1px solid var(--color-hairline); display: flex; gap: 12px; justify-content: flex-end; position: sticky; bottom: 0; background: white; }
.confirm-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; }
.confirm-overlay.show { display: flex; }
.confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 400px; text-align: center; }
.confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
.confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
.confirm-buttons { display: flex; gap: 12px; justify-content: center; }
.confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
.confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
.confirm-btn-cancel:hover { background: var(--color-hairline); }
.confirm-btn-logout { background: #dc2626; color: white; }
.confirm-btn-logout:hover { background: #b91c1c; }
.loading { text-align: center; padding: 40px; color: var(--color-body); }
.locked-notice { background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--rounded-md); padding: 12px; font-size: 13px; color: #92400e; margin-bottom: 16px; }
</style>
@endpush
@section('content')
<div class="mb-lg">
    <h1 class="text-2xl font-semibold mb-1">Welcome back, {{ auth()->user()->first_name }}!</h1>
    <p class="text-sm text-body">Here's an overview of your application status</p>
</div>

@if(session('success'))
@endif
@if(session('error'))
@endif

<div class="grid grid-cols-4 gap-5 mb-8 max-md:grid-cols-2">
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Total Applications</div>
        <div class="text-[28px] font-semibold">{{ $stats['total'] }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Pending</div>
        <div class="text-[28px] font-semibold">{{ $stats['pending'] }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Qualified</div>
        <div class="text-[28px] font-semibold">{{ $stats['qualified'] }}</div>
    </div>
    <div class="bg-surface-card border border-hairline rounded-lg p-5">
        <div class="text-[13px] text-muted mb-1">Disqualified</div>
        <div class="text-[28px] font-semibold">{{ $stats['disqualified'] }}</div>
    </div>
</div>

<div class="bg-surface-card border border-hairline rounded-lg overflow-hidden">
    <h2 class="text-base font-semibold px-lg pt-lg pb-4">My Applications</h2>
    @if($applications->count() > 0)
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Application Code</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Position</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Department</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Applied Date</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Status</th>
                    <th class="text-left px-4 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                    <tr class="hover:bg-canvas-soft transition-colors">
                        <td class="px-4 py-[14px] text-sm font-medium border-b border-hairline">{{ $app->application_code }}</td>
                        <td class="px-4 py-[14px] text-sm border-b border-hairline">{{ $app->job->plantillaPosition->position_name ?? '-' }}</td>
                        <td class="px-4 py-[14px] text-sm border-b border-hairline">{{ $app->job->plantillaPosition->department ?? '-' }}</td>
                        <td class="px-4 py-[14px] text-sm border-b border-hairline">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-[14px] text-sm border-b border-hairline"><span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background: var(--color-status-{{ $app->status }}-bg); color: var(--color-status-{{ $app->status }}-text);">{{ ucfirst($app->status) }}</span></td>
                        <td class="px-4 py-[14px] text-sm border-b border-hairline">
                            <button type="button" class="bg-surface-card text-ink text-sm font-medium px-[10px] py-1 border border-hairline-strong rounded-md cursor-pointer h-[30px] inline-flex items-center gap-[4px] hover:bg-surface-strong transition-colors" onclick="openViewModal({{ $app->id }})">View</button>
                            @if($app->status === 'pending')
                                <button type="button" class="bg-primary text-white text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer h-[30px] hover:bg-primary-active transition-colors ml-1" onclick="openEditModal({{ $app->id }})">Edit</button>
                                <button type="button" class="bg-[#fee2e2] text-[#dc2626] text-xs font-medium px-[10px] py-1 border-none rounded-md cursor-pointer hover:bg-[#fecaca] ml-1" onclick="showWithdrawConfirm({{ $app->id }})">Withdraw</button>
                            @else
                                <span class="text-muted text-[13px] ml-2">Locked</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-body text-center py-10">No applications yet. <a href="{{ route('applicant.jobs') }}" class="text-primary">Browse available jobs</a></p>
    @endif
</div>

<!-- Withdraw Confirmation -->
<div class="confirm-overlay" id="withdrawConfirm">
    <div class="confirm-box">
        <h3 class="confirm-title">Withdraw Application</h3>
        <p class="confirm-message">Are you sure you want to withdraw this application? This action cannot be undone.</p>
        <div class="confirm-buttons">
            <button type="button" class="confirm-btn confirm-btn-cancel" onclick="hideWithdrawConfirm()">Cancel</button>
            <button type="button" class="confirm-btn confirm-btn-logout" id="confirmWithdrawBtn">Withdraw</button>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal-overlay" id="viewModal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 class="modal-title" id="viewModalTitle">Application Details</h2>
            <button class="modal-close" onclick="closeViewModal()">&times;</button>
        </div>
        <div class="modal-body" id="viewModalBody">
            <div class="loading">Loading...</div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 class="modal-title">Edit Application</h2>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <div class="modal-body" id="editModalBody">
            <div class="loading">Loading...</div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeEditModal()" class="bg-surface-card text-ink text-sm font-medium px-4 py-2 border border-hairline-strong rounded-md cursor-pointer h-9 hover:bg-surface-strong transition-colors">Cancel</button>
            <button type="button" onclick="saveApplication()" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors">Save Changes</button>
        </div>
    </div>
</div>


@push('scripts')
<script>
@if(session('success')) showToast('{{ session('success') }}'); @endif
@if(session('error')) showToast('{{ session('error') }}', true); @endif

let withdrawForm = null;
function showWithdrawConfirm(id) {
    withdrawForm = document.querySelector('form[action*="/applicant/applications/" + id]');
    document.getElementById('withdrawConfirm').classList.add('show');
}
function hideWithdrawConfirm() { document.getElementById('withdrawConfirm').classList.remove('show'); }
document.getElementById('confirmWithdrawBtn')?.addEventListener('click', function() { if (withdrawForm) withdrawForm.submit(); });

let currentAppId = null;
async function openViewModal(appId) {
    currentAppId = appId;
    document.getElementById('viewModal').classList.add('show');
    document.getElementById('viewModalBody').innerHTML = '<div class="loading">Loading...</div>';
    try {
        const r = await fetch(`/applicant/applications/${appId}`, { headers: { 'Accept': 'application/json' } });
        if (!r.ok) throw new Error('Failed to load');
        renderViewModal(await r.json());
    } catch(e) { document.getElementById('viewModalBody').innerHTML = '<div class="loading">Error loading: ' + e.message + '</div>'; }
}
function closeViewModal() { document.getElementById('viewModal').classList.remove('show'); }
document.getElementById('viewModal')?.addEventListener('click', function(e) { if (e.target === this) closeViewModal(); });

function renderViewModal(app) {
    const body = document.getElementById('viewModalBody');
    const fmtDate = (d) => d ? new Date(d).toLocaleDateString('en-US', { month:'short', day:'numeric', year:'numeric' }) : '';
    const createdAt = fmtDate(app.created_at);

    /* ---------- Section 1: Job Summary ---------- */
    const job = app.job;
    const pp = job?.plantilla_position;
    const jobPdfLink = job?.job_description_pdf ? `/storage/${job.job_description_pdf}` : null;

    let html = `<div class="bg-canvas-soft rounded-md p-4 mb-4">
        <div class="flex justify-between items-start mb-2">
            <div>
                <h3 class="text-lg font-semibold text-ink">${pp?.position_name || '-'}</h3>
                <span class="inline-block text-[12px] text-body bg-surface-strong px-[8px] py-[2px] rounded-xs mt-1">${pp?.department || '-'}</span>
            </div>
            <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px] bg-status-open-bg text-status-open-text">Open</span>
        </div>
        <div class="grid grid-cols-2 gap-3 mt-3 text-sm">
            <div><span class="text-caption text-muted">Salary Grade</span><br><span class="text-body-sm">SG ${pp?.salary_grade || '-'}</span></div>
            <div><span class="text-caption text-muted">Monthly Salary</span><br><span class="text-body-sm">${job?.monthly_salary ? '\u20B1' + Number(job.monthly_salary).toLocaleString('en-US', {minimumFractionDigits:2}) : '-'}</span></div>
            <div><span class="text-caption text-muted">Deadline</span><br><span class="text-body-sm">${job?.deadline ? fmtDate(job.deadline) : '-'}</span></div>
            <div><span class="text-caption text-muted">Description</span><br><span class="text-body-sm text-body">${job?.description || '-'}</span></div>
        </div>`;
    if (jobPdfLink) {
        html += `<div class="mt-3 pt-3 border-t border-hairline"><a href="${jobPdfLink}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Job Description (PDF)</a></div>`;
    }
    html += `</div>`;

    /* ---------- Section 2: Application Status ---------- */
    const reviewedBy = app.reviewed_by;
    html += `<div class="border border-hairline rounded-md p-4 mb-4">
        <h4 class="text-sm font-semibold text-ink mb-3">Application Status</h4>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-caption text-muted">Application Code</span><br><span class="font-medium text-ink">${app.application_code || '-'}</span></div>
            <div><span class="text-caption text-muted">Submitted</span><br><span class="text-body-sm">${createdAt}</span></div>
            <div class="col-span-2"><span class="text-caption text-muted">Status</span><br><span class="inline-block mt-[2px] px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background:var(--color-status-${app.status}-bg);color:var(--color-status-${app.status}-text)">${app.status}</span></div>
        </div>`;
    if (reviewedBy) {
        const reviewedAt = fmtDate(app.reviewed_at);
        const name = reviewedBy.first_name + ' ' + (reviewedBy.middle_name ? reviewedBy.middle_name + ' ' : '') + reviewedBy.last_name;
        html += `<div class="mt-3 pt-3 border-t border-hairline text-sm"><span class="text-caption text-muted">Reviewed by</span><br><span class="text-body-sm">${name}${reviewedAt ? ' on ' + reviewedAt : ''}</span></div>`;
    }
    if (app.hr_notes) {
        html += `<div class="mt-3 pt-3 border-t border-hairline"><span class="text-caption text-muted">HR Notes</span><p class="text-body-sm text-body italic mt-1">${app.hr_notes}</p></div>`;
    }
    html += `</div>`;

    /* ---------- Merged: Evaluation + Data per sector ---------- */
    const evalMap = {};
    if (app.sector_evaluations) {
        app.sector_evaluations.forEach(se => { evalMap[se.sector] = se; });
    }
    const sectorOrder = ['education','training','experience','eligibility'];
    const sectorLabels = { education:'Education', training:'Training', experience:'Experience', eligibility:'Eligibility' };
    const dataKeys = { education:'educations', training:'trainings', experience:'experiences', eligibility:'eligibilities' };

    if (app.status !== 'pending') {
        html += `<div class="text-caption text-muted italic mb-4 p-3 rounded-md" style="background:#fef3c7;border:1px solid #f59e0b;color:#92400e;">This application has been ${app.status} and cannot be edited.</div>`;
    }

    sectorOrder.forEach(sector => {
        const label = sectorLabels[sector];
        const dataKey = dataKeys[sector];
        const se = evalMap[sector];
        const hasData = app[dataKey] && app[dataKey].length > 0;

        if (!se && !hasData) return;

        html += `<div class="border border-hairline rounded-md p-4 mb-4">`;

        if (se) {
            const seStatus = se.status || 'pending';
            const borderColor = seStatus === 'qualified' ? 'var(--color-status-qualified-text)' : seStatus === 'disqualified' ? 'var(--color-status-disqualified-text)' : 'var(--color-status-pending-text)';
            html += `<div class="flex justify-between items-center mb-2" style="border-left:4px solid ${borderColor};padding-left:12px;">
                <h4 class="text-sm font-semibold text-ink">${label}</h4>
                <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background:var(--color-status-${seStatus}-bg);color:var(--color-status-${seStatus}-text)">${seStatus}</span>
            </div>`;
            if (se.remarks) {
                html += `<p class="text-[13px] text-body mb-2 ml-[16px]">${se.remarks}</p>`;
            }
            const seDate = fmtDate(se.evaluated_at);
            const evaluator = se.evaluated_by;
            const evName = evaluator ? evaluator.first_name + ' ' + (evaluator.middle_name ? evaluator.middle_name + ' ' : '') + evaluator.last_name : '';
            if (evName) {
                html += `<p class="text-[11px] text-muted mb-3 ml-[16px]">by ${evName}${seDate ? ' on ' + seDate : ''}</p>`;
            }
        } else {
            html += `<h4 class="text-sm font-semibold text-ink mb-3">${label}</h4>`;
        }

        if (hasData) {
            app[dataKey].forEach(e => {
                const fu = e.file_path ? `/storage/${e.file_path}` : null;
                let title = '', detail = '';
                if (sector === 'education') {
                    title = e.level || '';
                    detail = `${e.school_name}${e.course?' - '+e.course:''} (${e.year_graduated})`;
                } else if (sector === 'training') {
                    title = e.training_title || '';
                    detail = `${e.training_hours||''} hours${e.date_conducted?' - '+fmtDate(e.date_conducted):''}`;
                } else if (sector === 'experience') {
                    title = e.position || '';
                    detail = `${fmtDate(e.start_date)}${e.is_present?' - Present':(e.end_date?' - '+fmtDate(e.end_date):'')}${e.sector?' | '+e.sector:''}`;
                } else if (sector === 'eligibility') {
                    title = e.eligibility_type?.name || e.other_name || 'Other';
                    detail = `${e.license_no?'License: '+e.license_no:''}${e.date_issued?' | Issued: '+fmtDate(e.date_issued):''}`;
                }
                html += `<div class="p-3 bg-canvas-soft rounded-md mb-2"><div class="font-medium text-sm mb-1">${title}</div><div class="text-[13px] text-body">${detail}</div>${fu?`<a href="${fu}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 mt-2 hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>`:''}</div>`;
            });
        } else {
            html += `<p class="text-[13px] text-muted italic">No ${label.toLowerCase()} submitted.</p>`;
        }

        html += `</div>`;
    });

    /* ---------- Other Requirements (bottom) ---------- */
    if (app.documents && app.documents.length > 0) {
        html += `<h4 class="text-sm font-semibold text-ink mb-3">Other Requirements</h4>`;
        html += `<div class="border border-hairline rounded-md p-4 mb-4">`;
        app.documents.forEach(doc => {
            const fu = doc.file_path ? `/storage/${doc.file_path}` : null;
            html += `<div class="flex justify-between items-center py-2 border-b border-hairline last:border-none"><span class="text-sm">${doc.document_type?.name||'Document'}</span>${fu?`<a href="${fu}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>`:''}</div>`;
        });
        html += `</div>`;
    }
    body.innerHTML = html;
}

let editAppData = null, editEligibilityTypes = [];
async function openEditModal(appId) {
    currentAppId = appId;
    document.getElementById('editModal').classList.add('show');
    document.getElementById('editModalBody').innerHTML = '<div class="loading">Loading...</div>';
    try {
        const r = await fetch(`/applicant/applications/${appId}/edit`, { headers: { 'Accept': 'application/json' } });
        if (!r.ok) throw new Error('Failed to load');
        const data = await r.json();
        editAppData = data.application;
        editEligibilityTypes = data.eligibilityTypes || [];
        renderEditModal(data.application);
    } catch(e) { document.getElementById('editModalBody').innerHTML = '<div class="loading">Error loading: ' + e.message + '</div>'; }
}
function closeEditModal() { document.getElementById('editModal').classList.remove('show'); }
document.getElementById('editModal')?.addEventListener('click', function(e) { if (e.target === this) closeEditModal(); });

function renderEditModal(app) {
    const body = document.getElementById('editModalBody');
    let html = `<form id="editForm" onsubmit="return false;">
        <div class="p-4 bg-canvas-soft rounded-md mb-5"><h3 class="text-base font-semibold mb-1">${app.job?.plantilla_position?.position_name || 'Position'}</h3><p class="text-sm text-body">${app.job?.plantilla_position?.department || ''}</p></div>`;
    html += `<h4 class="text-base font-semibold text-primary mt-5 mb-3">Education</h4><div id="education-entries">`;
    if (app.educations && app.educations.length > 0) app.educations.forEach((edu, i) => { html += renderEducationRow(edu, i); });
    html += `</div><button type="button" onclick="addEducation()" class="bg-surface-strong text-ink px-4 py-[10px] rounded-md border-none cursor-pointer text-sm font-medium mt-[10px]">+ Add Education</button>`;
    html += `<h4 class="text-base font-semibold text-primary mt-5 mb-3">Training</h4><div id="training-entries">`;
    if (app.trainings && app.trainings.length > 0) app.trainings.forEach((t, i) => { html += renderTrainingRow(t, i); });
    html += `</div><button type="button" onclick="addTraining()" class="bg-surface-strong text-ink px-4 py-[10px] rounded-md border-none cursor-pointer text-sm font-medium mt-[10px]">+ Add Training</button>`;
    html += `<h4 class="text-base font-semibold text-primary mt-5 mb-3">Work Experience</h4><div id="experience-entries">`;
    if (app.experiences && app.experiences.length > 0) app.experiences.forEach((e, i) => { html += renderExperienceRow(e, i); });
    html += `</div><button type="button" onclick="addExperience()" class="bg-surface-strong text-ink px-4 py-[10px] rounded-md border-none cursor-pointer text-sm font-medium mt-[10px]">+ Add Experience</button>`;
    html += `<h4 class="text-base font-semibold text-primary mt-5 mb-3">Eligibility</h4><div id="eligibility-entries">`;
    if (app.eligibilities && app.eligibilities.length > 0) app.eligibilities.forEach((e, i) => { html += renderEligibilityRow(e, i); });
    html += `</div><button type="button" onclick="addEligibility()" class="bg-surface-strong text-ink px-4 py-[10px] rounded-md border-none cursor-pointer text-sm font-medium mt-[10px]">+ Add Eligibility</button>`;
    html += `<h4 class="text-base font-semibold text-primary mt-5 mb-3">Other Requirements</h4><div id="documents-entries">`;
    if (app.documents && app.documents.length > 0) app.documents.forEach((d, i) => { html += renderDocumentRow(d, i); });
    else html += `<p class="text-muted text-xs italic">No documents required for this position.</p>`;
    html += `</div></form>`;
    body.innerHTML = html;
}

let eduIdx = 0, trainIdx = 0, expIdx = 0, eligIdx = 0;

function renderEducationRow(edu, idx) {
    const ef = edu?.file_path ? `<a href="/storage/${edu.file_path}" target="_blank" class="text-primary text-xs inline-flex items-center gap-1 mt-2 no-underline hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
    return `<div class="border border-hairline rounded-md p-5 mb-4 bg-canvas-soft"><div class="flex justify-between items-center mb-3"><span class="font-medium text-sm">Education</span><button type="button" onclick="this.closest('.border').remove()" class="text-[#dc2626] bg-none border-none cursor-pointer text-xs">Remove</button></div><input type="hidden" name="educations[${idx}][id]" value="${edu?.id||''}"><div class="grid grid-cols-2 gap-5"><div class="mb-4"><label class="block text-sm font-medium mb-2">Level</label><select name="educations[${idx}][level]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans bg-white"><option value="Elementary" ${edu?.level=='Elementary'?'selected':''}>Elementary</option><option value="High School" ${edu?.level=='High School'?'selected':''}>High School</option><option value="Senior High School" ${edu?.level=='Senior High School'?'selected':''}>Senior High School</option><option value="Bachelors" ${!edu||edu?.level=='Bachelors'?'selected':''}>Bachelors</option><option value="Masters" ${edu?.level=='Masters'?'selected':''}>Masters</option><option value="Doctorate" ${edu?.level=='Doctorate'?'selected':''}>Doctorate</option></select></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Year Graduated</label><input type="number" name="educations[${idx}][year_graduated]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${edu?.year_graduated||''}" min="1900" max="2099"></div></div><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">School Name *</label><input type="text" name="educations[${idx}][school_name]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${edu?.school_name||''}" required></div><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">Course</label><input type="text" name="educations[${idx}][course]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${edu?.course||''}"></div><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">Document (PDF, JPG, PNG)</label><input type="file" name="educations[${idx}][file]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png">${ef}</div></div>`;
}

function renderTrainingRow(train, idx) {
    const ef = train?.file_path ? `<a href="/storage/${train.file_path}" target="_blank" class="text-primary text-xs inline-flex items-center gap-1 mt-2 no-underline hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
    return `<div class="border border-hairline rounded-md p-5 mb-4 bg-canvas-soft"><div class="flex justify-between items-center mb-3"><span class="font-medium text-sm">Training</span><button type="button" onclick="this.closest('.border').remove()" class="text-[#dc2626] bg-none border-none cursor-pointer text-xs">Remove</button></div><input type="hidden" name="trainings[${idx}][id]" value="${train?.id||''}"><div class="grid grid-cols-2 gap-5"><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">Training Title *</label><input type="text" name="trainings[${idx}][training_title]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${train?.training_title||''}" required></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Hours</label><input type="number" name="trainings[${idx}][training_hours]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${train?.training_hours||''}"></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Date</label><input type="date" name="trainings[${idx}][date_conducted]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${train?.date_conducted||''}"></div><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">Document</label><input type="file" name="trainings[${idx}][file]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png">${ef}</div></div></div>`;
}

function renderExperienceRow(exp, idx) {
    const ef = exp?.file_path ? `<a href="/storage/${exp.file_path}" target="_blank" class="text-primary text-xs inline-flex items-center gap-1 mt-2 no-underline hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
    return `<div class="border border-hairline rounded-md p-5 mb-4 bg-canvas-soft"><div class="flex justify-between items-center mb-3"><span class="font-medium text-sm">Work Experience</span><button type="button" onclick="this.closest('.border').remove()" class="text-[#dc2626] bg-none border-none cursor-pointer text-xs">Remove</button></div><input type="hidden" name="experiences[${idx}][id]" value="${exp?.id||''}"><div class="grid grid-cols-2 gap-5"><div class="mb-4"><label class="block text-sm font-medium mb-2">Position *</label><input type="text" name="experiences[${idx}][position]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${exp?.position||''}" required></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Employer *</label><input type="text" name="experiences[${idx}][employer]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${exp?.employer||''}" required></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Start Date *</label><input type="date" name="experiences[${idx}][start_date]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${exp?.start_date||''}" required></div><div class="mb-4"><label class="block text-sm font-medium mb-2">End Date</label><input type="date" name="experiences[${idx}][end_date]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${exp?.end_date||''}" ${exp?.is_present?'disabled':''}></div><div class="mb-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="experiences[${idx}][is_present]" value="1" ${exp?.is_present?'checked':''} onchange="toggleEndDate(this)"> Currently Working</label></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Sector</label><select name="experiences[${idx}][sector]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans bg-white"><option value="">Select</option><option value="Government" ${exp?.sector=='Government'?'selected':''}>Government</option><option value="Private" ${exp?.sector=='Private'?'selected':''}>Private</option><option value="NGO" ${exp?.sector=='NGO'?'selected':''}>NGO</option></select></div><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">Document</label><input type="file" name="experiences[${idx}][file]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png">${ef}</div></div></div>`;
}

function renderEligibilityRow(elig, idx) {
    const ef = elig?.file_path ? `<a href="/storage/${elig.file_path}" target="_blank" class="text-primary text-xs inline-flex items-center gap-1 mt-2 no-underline hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
    const types = editEligibilityTypes.map(t => `<option value="${t.id}" ${elig?.eligibility_type_id==t.id?'selected':''}>${t.name}</option>`).join('');
    return `<div class="border border-hairline rounded-md p-5 mb-4 bg-canvas-soft"><div class="flex justify-between items-center mb-3"><span class="font-medium text-sm">Eligibility</span><button type="button" onclick="this.closest('.border').remove()" class="text-[#dc2626] bg-none border-none cursor-pointer text-xs">Remove</button></div><input type="hidden" name="eligibilities[${idx}][id]" value="${elig?.id||''}"><div class="grid grid-cols-2 gap-5"><div class="mb-4"><label class="block text-sm font-medium mb-2">Type</label><select name="eligibilities[${idx}][eligibility_type_id]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans bg-white"><option value="">Select</option>${types}</select></div><div class="mb-4"><label class="block text-sm font-medium mb-2">License Number</label><input type="text" name="eligibilities[${idx}][license_no]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${elig?.license_no||''}"></div><div class="mb-4"><label class="block text-sm font-medium mb-2">Date Issued</label><input type="date" name="eligibilities[${idx}][date_issued]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" value="${elig?.date_issued||''}"></div><div class="mb-4 col-span-2"><label class="block text-sm font-medium mb-2">Document</label><input type="file" name="eligibilities[${idx}][file]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png">${ef}</div></div></div>`;
}

function renderDocumentRow(doc, idx) {
    const ef = doc?.file_path ? `<a href="/storage/${doc.file_path}" target="_blank" class="text-primary text-xs inline-flex items-center gap-1 mt-2 no-underline hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Existing Document</a>` : '';
    return `<div class="border border-hairline rounded-md p-5 mb-4 bg-canvas-soft"><div class="flex justify-between items-center mb-3"><span class="font-medium text-sm">${doc.document_type?.name||'Document'}</span><button type="button" onclick="this.closest('.border').remove()" class="text-[#dc2626] bg-none border-none cursor-pointer text-xs">Remove</button></div><input type="hidden" name="documents[${idx}][id]" value="${doc?.id||''}"><div class="mb-4"><label class="block text-sm font-medium mb-2">Replace Document</label><input type="file" name="documents[${idx}][file]" class="w-full px-3 py-[12px] border border-hairline-strong rounded-md text-sm font-sans" accept=".pdf,.jpg,.jpeg,.png">${ef}</div></div>`;
}

function addEducation() { const c = document.getElementById('education-entries'); const d = document.createElement('div'); d.innerHTML = renderEducationRow(null, eduIdx++); c.appendChild(d.firstElementChild); }
function addTraining() { const c = document.getElementById('training-entries'); const d = document.createElement('div'); d.innerHTML = renderTrainingRow(null, trainIdx++); c.appendChild(d.firstElementChild); }
function addExperience() { const c = document.getElementById('experience-entries'); const d = document.createElement('div'); d.innerHTML = renderExperienceRow(null, expIdx++); c.appendChild(d.firstElementChild); }
function addEligibility() { const c = document.getElementById('eligibility-entries'); const d = document.createElement('div'); d.innerHTML = renderEligibilityRow(null, eligIdx++); c.appendChild(d.firstElementChild); }

function toggleEndDate(cb) { const ei = cb.closest('.grid').querySelector('input[name*="end_date"]'); if(ei){ei.disabled=cb.checked;if(cb.checked)ei.value='';} }

async function saveApplication() {
    const form = document.getElementById('editForm');
    const fd = new FormData();
    fd.append('_method', 'PUT');
    fd.append('_token', document.querySelector('meta[name="csrf-token"]')?.content||'');
    // Serialize all form fields
    form.querySelectorAll('input, select, textarea').forEach(el => {
        if (el.type === 'file') { if (el.files[0]) fd.append(el.name, el.files[0]); }
        else if (el.type === 'checkbox') { if (el.checked) fd.append(el.name, el.value); }
        else if (el.name) fd.append(el.name, el.value);
    });
    try {
        const r = await fetch(`/applicant/applications/${currentAppId}`, { method:'POST', body:fd, headers:{'Accept':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]')?.content||''} });
        const d = await r.json();
        if (d.success) { showToast('Application updated!'); closeEditModal(); setTimeout(()=>location.reload(),1000); }
        else showToast('Error: '+(d.message||'Something went wrong'), true);
    } catch(e) { showToast('Error saving', true); }
}

</script>
@endpush
@endsection