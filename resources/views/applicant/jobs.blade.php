@extends('layouts.applicant')
@section('title', 'Job Openings - DEPED Region V Recruitment')
@push('styles')
<style>
.confirm-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; padding: 20px; }
.confirm-overlay.show { display: flex; }
.confirm-box { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 600px; width: 100%; max-height: 90vh; overflow-y: auto; }
.confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
.confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
.confirm-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
.confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
.confirm-btn-cancel { background: var(--color-surface-strong); color: var(--color-ink); }
.confirm-btn-danger { background: #dc2626; color: white; }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.modal-close-btn { background: none; border: none; font-size: 24px; color: var(--color-muted); cursor: pointer; padding: 4px; line-height: 1; }
.modal-close-btn:hover { color: var(--color-ink); }
</style>
@endpush
@section('content')
<div class="mb-lg flex items-center justify-between flex-wrap gap-base">
    <div>
        <h1 class="text-2xl font-semibold mb-1">Job Openings</h1>
        <p class="text-sm text-body">Browse and apply for available positions</p>
    </div>
    <div class="flex gap-3 flex-wrap">
        <select class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card cursor-pointer" id="departmentFilter" onchange="filterJobs()">
            <option value="">All Departments</option>
        </select>
        <select class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card cursor-pointer" id="positionFilter" onchange="filterJobs()">
            <option value="">All Positions</option>
        </select>
        <select class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card cursor-pointer" id="sortFilter" onchange="sortJobs()">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="deadline">Deadline (Soonest)</option>
            <option value="deadline-late">Deadline (Latest)</option>
            <option value="salary-high">Salary (High to Low)</option>
            <option value="salary-low">Salary (Low to High)</option>
        </select>
    </div>
</div>

@if(session('error'))<script>showToast('{{ session('error') }}',true)</script>@endif

<div id="jobsContainer">
    @foreach($jobPostings as $job)
        <div class="bg-surface-card border border-hairline rounded-lg mb-5 overflow-hidden" data-job-id="{{ $job->id }}" data-department="{{ $job->plantillaPosition->department ?? '' }}" data-position="{{ $job->plantillaPosition->position_name ?? '' }}">
            <div class="flex items-start justify-between p-5">
                <div class="flex-1">
                    <div class="text-base font-semibold mb-1">{{ $job->plantillaPosition->position_name ?? 'Position' }}</div>
                    <div class="text-sm text-body mb-2">{{ $job->plantillaPosition->department ?? 'Department' }} | Item No: {{ $job->plantillaPosition->plantilla_item_no ?? '-' }}</div>
                    <div class="flex gap-5 text-[13px] text-muted flex-wrap">
                        <span>SG-{{ $job->plantillaPosition->salary_grade ?? '-' }}</span>
                        <span>PHP {{ number_format($job->monthly_salary, 2) }}/month</span>
                        <span>{{ $job->applications_count }} applicant{{ $job->applications_count != 1 ? 's' : '' }}</span>
                        <span>Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>
                        <span class="posted-time" data-posted="{{ ($job->posted_at ?? $job->created_at)->toIsoString() }}"></span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="button" class="bg-surface-card text-ink text-sm font-medium px-[10px] py-1 border border-hairline-strong rounded-md cursor-pointer h-[30px] hover:bg-surface-strong transition-colors" onclick="viewJob({{ $job->id }})">View</button>
                    @if(in_array($job->id, $appliedJobIds))
                        <span class="bg-surface-strong text-muted text-sm font-medium px-4 py-[6px] rounded-md">Already Applied</span>
                    @else
                        <a href="#" onclick="openApplyModal({{ $job->id }}); return false;" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 inline-flex items-center gap-2 hover:bg-primary-active transition-colors no-underline">Apply Now</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($jobPostings->count() == 0)
    <div class="bg-surface-card border border-hairline rounded-lg p-10 text-center">
        <p class="text-body">No job openings available at the moment.</p>
    </div>
@endif

<!-- Job Detail Modal -->
<div class="confirm-overlay" id="jobDetailModal">
    <div class="confirm-box" style="max-width:600px;">
        <div class="modal-header">
            <h3 class="confirm-title" id="detailJobTitle">Job Details</h3>
            <button type="button" class="modal-close-btn" onclick="closeJobDetail()">&times;</button>
        </div>
        <div id="detailJobContent"></div>
        <div class="confirm-buttons" style="margin-top:24px;padding-top:20px;border-top:1px solid var(--color-hairline);">
            <button type="button" class="confirm-btn confirm-btn-cancel" onclick="closeJobDetail()">Close</button>
            <button type="button" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors" id="detailApplyBtn" onclick="applyFromDetail()">Apply Now</button>
        </div>
    </div>
</div>

<!-- Apply Modal -->
<div class="confirm-overlay" id="applyModal">
    <div class="confirm-box" style="max-width:950px;width:95%;">
        <h3 class="confirm-title" id="applyModalTitle">Apply for Position</h3>
        <div id="applyModalContent" style="max-height:75vh;overflow-y:auto;"></div>
        <div class="confirm-buttons">
            <button type="button" class="confirm-btn confirm-btn-cancel" onclick="closeApplyModal()">Cancel</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let jobData = @json($jobPostings);
let appliedJobIds = @json($appliedJobIds);
let currentApplyJobId = null;

function getRelativeTime(dateStr) {
    if (!dateStr) return 'Recently';
    const date = new Date(dateStr);
    if (isNaN(date.getTime())) return 'Recently';
    const now = new Date();
    const diffMs = now - date;
    if (diffMs < 0) return 'Just now';
    const diffMins = Math.floor(diffMs / 60000);
    if (diffMins < 1) return 'Just now';
    if (diffMins < 60) return diffMins + ' min' + (diffMins !== 1 ? 's' : '') + ' ago';
    const diffHours = Math.floor(diffMins / 60);
    if (diffHours < 24) return diffHours + ' hour' + (diffHours !== 1 ? 's' : '') + ' ago';
    const diffDays = Math.floor(diffHours / 24);
    if (diffDays < 7) return diffDays + ' day' + (diffDays !== 1 ? 's' : '') + ' ago';
    const diffWeeks = Math.floor(diffDays / 7);
    if (diffWeeks < 4) return diffWeeks + ' week' + (diffWeeks !== 1 ? 's' : '') + ' ago';
    const diffMonths = Math.floor(diffDays / 30);
    if (diffMonths < 12) return diffMonths + ' month' + (diffMonths !== 1 ? 's' : '') + ' ago';
    const diffYears = Math.floor(diffDays / 365);
    return diffYears + ' year' + (diffYears !== 1 ? 's' : '') + ' ago';
}

const departments = [...new Set(jobData.map(j => j.plantilla_position?.department).filter(Boolean))];
const deptSelect = document.getElementById('departmentFilter');
departments.forEach(dept => { const opt = document.createElement('option'); opt.value = dept; opt.textContent = dept; deptSelect.appendChild(opt); });

const positions = [...new Set(jobData.map(j => j.plantilla_position?.position_name).filter(Boolean))];
const posSelect = document.getElementById('positionFilter');
positions.forEach(pos => { const opt = document.createElement('option'); opt.value = pos; opt.textContent = pos; posSelect.appendChild(opt); });

function filterJobs() {
    const dept = document.getElementById('departmentFilter').value;
    const pos = document.getElementById('positionFilter').value;
    document.querySelectorAll('[data-job-id]').forEach(card => {
        const md = !dept || card.dataset.department === dept;
        const mp = !pos || card.dataset.position === pos;
        card.style.display = (md && mp) ? 'block' : 'none';
    });
}

function sortJobs() {
    const sv = document.getElementById('sortFilter').value;
    const container = document.getElementById('jobsContainer');
    const cards = Array.from(container.querySelectorAll('[data-job-id]'));
    cards.sort((a, b) => {
        const ja = jobData.find(j => j.id === parseInt(a.dataset.jobId));
        const jb = jobData.find(j => j.id === parseInt(b.dataset.jobId));
        if (!ja || !jb) return 0;
        switch(sv) {
            case 'oldest': return new Date(ja.posted_at||ja.created_at) - new Date(jb.posted_at||jb.created_at);
            case 'deadline': return new Date(ja.deadline) - new Date(jb.deadline);
            case 'deadline-late': return new Date(jb.deadline) - new Date(ja.deadline);
            case 'salary-high': return jb.monthly_salary - ja.monthly_salary;
            case 'salary-low': return ja.monthly_salary - jb.monthly_salary;
            default: return new Date(jb.posted_at||jb.created_at) - new Date(ja.posted_at||ja.created_at);
        }
    });
    cards.forEach(c => container.appendChild(c));
}

function viewJob(id) {
    const job = jobData.find(j => j.id === id);
    if (!job) return;
    currentApplyJobId = id;
    const dept = job.plantilla_position?.department || '-', pos = job.plantilla_position?.position_name || '-';
    const itemNo = job.plantilla_position?.plantilla_item_no || '-', sg = job.plantilla_position?.salary_grade || '-';
    const salary = parseFloat(job.monthly_salary).toLocaleString('en-PH', {minimumFractionDigits:2});
    const deadline = new Date(job.deadline).toLocaleDateString('en-PH', {year:'numeric',month:'long',day:'numeric'});
    let postedDate = 'N/A';
    try { const p = job.posted_at||job.created_at; if(p){const d=new Date(p);if(!isNaN(d.getTime()))postedDate=d.toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'});}}catch(e){}
    const applicants = job.applications_count || 0, alreadyApplied = appliedJobIds.includes(job.id);
    let pdfHtml = job.job_description_pdf ? `<a href="/storage/${job.job_description_pdf}" target="_blank" class="bg-primary text-white px-4 py-[10px] rounded-md text-sm font-medium no-underline inline-flex items-center gap-2 hover:bg-primary-active"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg> View Job Description PDF</a>` : `<span class="bg-surface-strong text-body px-4 py-[10px] rounded-md text-sm inline-flex items-center gap-2"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> No PDF attached</span>`;
    let qualHtml = '';
    if (job.required_education) qualHtml += `<div class="py-[10px] border-b border-hairline last:border-none"><div class="text-xs text-muted uppercase tracking-[0.3px] mb-1">Education</div><div class="text-sm">${job.required_education}</div></div>`;
    if (job.required_training) qualHtml += `<div class="py-[10px] border-b border-hairline last:border-none"><div class="text-xs text-muted uppercase tracking-[0.3px] mb-1">Training</div><div class="text-sm">${job.required_training}</div></div>`;
    if (job.required_experience) qualHtml += `<div class="py-[10px] border-b border-hairline last:border-none"><div class="text-xs text-muted uppercase tracking-[0.3px] mb-1">Experience</div><div class="text-sm">${job.required_experience}</div></div>`;
    if (job.required_eligibility) qualHtml += `<div class="py-[10px] border-b border-hairline last:border-none"><div class="text-xs text-muted uppercase tracking-[0.3px] mb-1">Eligibility</div><div class="text-sm">${job.required_eligibility}</div></div>`;
    let descHtml = job.description ? `<div class="bg-canvas-soft rounded-[10px] p-4"><div class="text-[13px] font-semibold text-ink mb-3 flex items-center gap-[6px]"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#0057B8;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>Description</div><div class="text-sm">${job.description}</div></div>` : '';
    document.getElementById('detailJobContent').innerHTML = `
        <div class="flex items-start gap-4 pb-5 border-b border-hairline mb-5">
            <div class="w-14 h-14 shrink-0 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#0057B8,#004494);">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
            </div>
            <div class="flex-1">
                <div class="text-xl font-semibold mb-1">${pos}</div>
                <div class="text-sm text-body">${dept}</div>
                <div class="text-[13px] text-muted mt-1">Plantilla Item No: ${itemNo}</div>
                <div class="flex gap-2 mt-2 flex-wrap">
                    <span class="inline-flex items-center gap-1 px-[10px] py-1 bg-canvas-soft rounded-[20px] text-xs text-body"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> ${applicants} applicant${applicants!=1?'s':''}</span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-canvas-soft rounded-[10px] p-4">
                <div class="text-[13px] font-semibold text-ink mb-3 flex items-center gap-[6px]"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#0057B8;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Timeline</div>
                <div class="py-1 border-none"><div class="text-xs text-muted uppercase">Posted</div><div class="text-sm">${getRelativeTime(job.posted_at||job.created_at)}</div></div>
                <div class="py-1 border-none"><div class="text-xs text-muted uppercase">Deadline</div><div class="text-sm">${deadline}</div></div>
            </div>
            <div class="bg-canvas-soft rounded-[10px] p-4">
                <div class="text-[13px] font-semibold text-ink mb-3 flex items-center gap-[6px]"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#0057B8;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Position</div>
                <div class="py-1 border-none"><div class="text-xs text-muted uppercase">Salary Grade</div><div class="text-sm">SG-${sg}</div></div>
                <div class="py-1 border-none"><div class="text-xs text-muted uppercase">Monthly Salary</div><div class="text-sm" style="color:#16a34a;font-weight:600;">PHP ${salary}</div></div>
            </div>
            ${descHtml ? `<div class="col-span-2">${descHtml}</div>` : ''}
            ${qualHtml ? `<div class="col-span-2"><div class="bg-canvas-soft rounded-[10px] p-4"><div class="text-[13px] font-semibold text-ink mb-3 flex items-center gap-[6px]"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#0057B8;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>Qualification Standards</div>${qualHtml}</div></div>` : ''}
            <div class="col-span-2"><div class="text-[11px] font-semibold text-muted uppercase tracking-[0.5px] mb-2">Job Description</div>${pdfHtml}</div>
        </div>`;
    const ab = document.getElementById('detailApplyBtn');
    if (alreadyApplied) { ab.textContent='Already Applied';ab.disabled=true;ab.style.opacity='0.5';ab.style.cursor='default'; }
    else { ab.textContent='Apply Now';ab.disabled=false;ab.style.opacity='1';ab.style.cursor='pointer'; }
    document.getElementById('jobDetailModal').classList.add('show');
}
function closeJobDetail() { document.getElementById('jobDetailModal').classList.remove('show'); }
function applyFromDetail() { const b=document.getElementById('detailApplyBtn');if(b.disabled)return;closeJobDetail();openApplyModal(currentApplyJobId); }

function openApplyModal(jobId) {
    currentApplyJobId = jobId;
    const job = jobData.find(j => j.id === jobId);
    if (!job) return;
    document.getElementById('applyModalTitle').textContent = 'Apply for ' + (job.plantilla_position?.position_name || 'Position');
    document.getElementById('applyModalContent').innerHTML = '<div style="text-align:center;padding:40px;">Loading application form...</div>';
    document.getElementById('applyModal').classList.add('show');
    fetch('/applicant/jobs/' + jobId + '/apply-form')
        .then(r => r.text())
        .then(html => {
            const scriptMatch = html.match(/<script>([\s\S]*?)<\/script>/);
            const scriptContent = scriptMatch ? scriptMatch[1] : '';
            const htmlWithoutScript = html.replace(/<script>[\s\S]*?<\/script>/, '');
            document.getElementById('applyModalContent').innerHTML = htmlWithoutScript;
            if (scriptContent) { try { eval(scriptContent); } catch(e) { console.error('Script error:', e); } }
        })
        .catch(() => { document.getElementById('applyModalContent').innerHTML = '<div style="text-align:center;padding:40px;color:red;">Error loading form</div>'; });
}
function closeApplyModal() { document.getElementById('applyModal').classList.remove('show'); currentApplyJobId = null; }

document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeJobDetail(); closeApplyModal(); } });
document.getElementById('jobDetailModal')?.addEventListener('click', function(e) { if (e.target === this) closeJobDetail(); });
document.getElementById('applyModal')?.addEventListener('click', function(e) { if (e.target === this) closeApplyModal(); });

function updateRelativeTimes() {
    document.querySelectorAll('.posted-time').forEach(function(el) {
        const postedAt = el.dataset.posted;
        if (postedAt) el.textContent = getRelativeTime(postedAt);
    });
}
updateRelativeTimes();
setInterval(updateRelativeTimes, 60000);
</script>
@endpush
@endsection