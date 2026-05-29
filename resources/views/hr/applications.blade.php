@extends('layouts.hr')
@section('title', 'Applications - DEPED Region V Recruitment')
@push('styles')
<style>
.modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 2000; padding: 20px; overflow-y: auto; cursor: pointer; }
.modal-overlay.show { display: block; }
</style>
@endpush
@section('content')
<div class="mb-lg flex items-center justify-between flex-wrap gap-base">
    <div>
        <h1 class="text-2xl font-semibold mb-1">Applications</h1>
        <p class="text-sm text-body">Manage and review job applications</p>
    </div>
    <div class="flex gap-3 flex-wrap">
        <select class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card cursor-pointer" id="jobFilter" onchange="filterApplications()">
            <option value="all">All Jobs</option>
            @foreach($jobPostings as $job)
                <option value="{{ $job->id }}">{{ $job->plantillaPosition->position_name ?? 'Position' }} ({{ $job->plantillaPosition->department ?? 'Department' }})</option>
            @endforeach
        </select>
        <select class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card cursor-pointer" id="statusFilter" onchange="filterApplications()">
            <option value="all">All Status</option>
            <option value="pending">Pending</option>
            <option value="qualified">Qualified</option>
            <option value="disqualified">Disqualified</option>
        </select>
    </div>
</div>


@if(session('success'))
<script>showToast('{{ session('success') }}');</script>
@endif

<div class="bg-surface-card border border-hairline rounded-lg overflow-hidden">
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Application Code</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Applicant</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Position</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Department</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Status</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Submitted</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Actions</th>
            </tr>
        </thead>
        <tbody id="applicationsTable">
            @forelse($applications as $app)
                <tr data-job-id="{{ $app->job_id }}" data-status="{{ $app->status }}" class="hover:bg-canvas-soft transition-colors">
                    <td class="px-base py-[14px] text-sm font-medium border-b border-hairline">{{ $app->application_code }}</td>
                    <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $app->user->first_name ?? '-' }} {{ $app->user->last_name ?? '' }}</td>
                    <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $app->job->plantillaPosition->position_name ?? '-' }}</td>
                    <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $app->job->plantillaPosition->department ?? '-' }}</td>
                    <td class="px-base py-[14px] text-sm border-b border-hairline">
                        <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background: var(--color-status-{{ $app->status }}-bg); color: var(--color-status-{{ $app->status }}-text);">{{ ucfirst($app->status) }}</span>
                    </td>
                    <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $app->created_at->format('M d, Y') }}</td>
                    <td class="px-base py-[14px] text-sm border-b border-hairline">
                        <button type="button" class="bg-surface-card text-ink text-sm font-medium px-base py-2 border border-hairline-strong rounded-md cursor-pointer inline-flex items-center gap-[6px] h-9 hover:bg-surface-strong transition-colors" onclick="openReviewModal({{ $app->id }})">Review</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-10 text-sm">No applications found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Review Modal -->
<div class="modal-overlay" id="reviewModal">
    <div class="bg-white rounded-lg max-w-[900px] mx-auto my-5 max-h-[calc(100vh-40px)] overflow-y-auto" style="cursor: default;" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between px-lg py-5 border-b border-hairline sticky top-0 bg-white z-[1]">
            <h2 class="text-xl font-semibold" id="reviewModalTitle">Application Review</h2>
            <button class="bg-none border-none text-[28px] cursor-pointer text-body leading-none hover:text-ink transition-colors" onclick="closeReviewModal()">&times;</button>
        </div>
        <div class="p-lg" id="reviewModalBody">
            <div class="text-center py-10 text-body">Loading application details...</div>
        </div>
        <div class="flex items-center justify-between px-lg py-base border-t border-hairline sticky bottom-0 bg-white">
            <div id="generalStatusSection" class="flex-1">
                <div class="bg-[#fef3c7] border border-[#f59e0b] rounded-md p-3 text-xs text-[#92400e] mb-base hidden" id="statusWarning"></div>
                <form id="generalStatusForm" method="POST" action="" class="flex gap-3 items-end flex-wrap">
                    @csrf
                    @method('PUT')
                    <div class="flex-1 min-w-[150px]">
                        <label class="block text-xs font-medium mb-[6px]">General Status</label>
                        <select name="status" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans" id="generalStatusSelect" style="min-width:150px;">
                            <option value="pending">Pending</option>
                            <option value="qualified">Qualified</option>
                            <option value="disqualified">Disqualified</option>
                        </select>
                    </div>
                    <div class="flex-[2] min-w-[200px]">
                        <label class="block text-xs font-medium mb-[6px]">Notes</label>
                        <textarea name="hr_notes" class="w-full px-3 py-[10px] border border-hairline-strong rounded-md text-sm font-sans resize-vertical" id="generalStatusNotes" placeholder="Add notes..." style="min-height:60px;"></textarea>
                    </div>
                    <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    function filterApplications() {
        const jf = document.getElementById('jobFilter').value, sf = document.getElementById('statusFilter').value;
        document.querySelectorAll('#applicationsTable tr').forEach(r => {
            const mj = jf === 'all' || r.dataset.jobId === jf, ms = sf === 'all' || r.dataset.status === sf;
            r.style.display = (mj && ms) ? 'table-row' : 'none';
        });
    }
    let currentAppId = null, sectorEvaluations = {};
    async function openReviewModal(appId) {
        currentAppId = appId;
        document.getElementById('reviewModal').classList.add('show');
        document.getElementById('reviewModalBody').innerHTML = '<div class="text-center py-10 text-body">Loading application details...</div>';
        try {
            const r = await fetch(`/hr/applications/${appId}/details`), data = await r.json();
            sectorEvaluations = {};
            if (data.sectorEvaluations) Object.keys(data.sectorEvaluations).forEach(k => sectorEvaluations[k] = data.sectorEvaluations[k]);
            renderApplicationDetails(data.application);
        } catch(e) {
            document.getElementById('reviewModalBody').innerHTML = '<div class="text-center py-10 text-body">Error loading application details.</div>';
        }
    }
    function closeReviewModal() { document.getElementById('reviewModal').classList.remove('show'); currentAppId = null; }
    function renderApplicationDetails(app) {
        const body = document.getElementById('reviewModalBody');
        const createdAt = new Date(app.created_at).toLocaleDateString('en-US', { month:'short', day:'numeric', year:'numeric' });
        let html = `<div class="flex gap-base flex-wrap mb-base">` +
            ['Application Code', 'Applicant', 'Position', 'Department', 'Submitted', 'Current Status'].map((l, i) => {
                const vals = [app.application_code, (app.user?.first_name||'')+' '+(app.user?.last_name||''), app.job?.plantilla_position?.position_name||'-', app.job?.plantilla_position?.department||'-', createdAt, `<span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background:var(--color-status-${app.status}-bg);color:var(--color-status-${app.status}-text)">${app.status}</span>`];
                return `<div class="flex-1 min-w-[150px] p-3 bg-canvas-soft rounded-md"><div class="text-xs text-muted mb-1">${l}</div><div class="text-sm font-medium">${vals[i]}</div></div>`;
            }).join('') + `</div>`;
        html += renderSectorSection('education', app.educations, [{title:'Level',key:'level'},{title:'School',key:'school_name'},{title:'Course',key:'course'},{title:'Year',key:'year_graduated'}]);
        html += renderSectorSection('training', app.trainings, [{title:'Title',key:'training_title'},{title:'Hours',key:'training_hours'},{title:'Date',key:'date_conducted'}]);
        html += renderSectorSection('experience', app.experiences, [{title:'Position',key:'position'},{title:'Employer',key:'employer'},{title:'Period',key:'period'},{title:'Sector',key:'sector'}]);
        html += renderSectorSection('eligibility', app.eligibilities, [{title:'Type',key:'type'},{title:'License No',key:'license_no'},{title:'Date Issued',key:'date_issued'}]);
        html += `<div class="text-base font-semibold text-primary mt-lg mb-3">Other Requirements</div>`;
        if (app.documents && app.documents.length > 0) {
            app.documents.forEach(doc => {
                const fu = doc.file_path ? `/storage/${doc.file_path}` : null;
                html += `<div class="border border-hairline rounded-md p-base mb-3">` +
                    `<div class="flex items-start justify-between flex-wrap gap-2"><div><div class="font-medium text-sm">${doc.document_type?.name||'Document'}</div>` +
                    (fu ? `<a href="${fu}" target="_blank" class="text-primary no-underline text-xs inline-flex items-center gap-1 hover:underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> View Document</a>` : '') +
                    `</div></div></div>`;
            });
        } else html += '<p class="text-xs text-muted italic">No documents uploaded</p>';
        document.getElementById('generalStatusForm').action = `/hr/applications/${app.id}/status`;
        document.getElementById('generalStatusNotes').value = app.hr_notes || '';
        const allEval = ['education','training','experience','eligibility'].every(s => sectorEvaluations[s] && (sectorEvaluations[s].status==='qualified'||sectorEvaluations[s].status==='disqualified'));
        const ss = document.getElementById('generalStatusSelect');
        ss.innerHTML = `<option value="pending" ${app.status==='pending'?'selected':''}>Pending</option><option value="qualified" ${app.status==='qualified'?'selected':''} ${!allEval?'disabled':''}>Qualified</option><option value="disqualified" ${app.status==='disqualified'?'selected':''}>Disqualified</option>`;
        body.innerHTML = html;
    }
    function formatDate(d) { return d ? new Date(d).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}) : '-'; }
    function renderSectorSection(name, entries, fields) {
        const title = name.charAt(0).toUpperCase()+name.slice(1), ev = sectorEvaluations[name];
        const status = ev?.status||'', isQ = status==='qualified', isD = status==='disqualified';
        const badge = isQ ? `<span class="text-xs font-semibold px-[14px] py-[6px] rounded-[20px]" style="background:#dcfce7;color:#166534">Qualified</span>` :
            isD ? `<span class="text-xs font-semibold px-[14px] py-[6px] rounded-[20px]" style="background:#fee2e2;color:#991b1b">Disqualified</span>` :
            `<span class="text-xs font-semibold px-[14px] py-[6px] rounded-[20px]" style="background:#f3f4f6;color:#6b7280">Not Evaluated</span>`;
        let html = `<div class="border border-hairline rounded-[10px] mb-5 overflow-hidden bg-white">` +
            `<div class="flex items-center justify-between px-5 py-base" style="background:#f8fafc;border-bottom:1px solid #e5e7eb;"><h3 class="m-0 text-base font-semibold" style="color:#1e293b;">${title}</h3>${badge}</div>` +
            `<div class="p-5">`;
        if (entries && entries.length > 0) {
            entries.forEach((e, i) => {
                html += `<div class="flex gap-base py-[14px] border-b border-[#f1f5f9] last:border-none"><div class="w-[26px] h-[26px] rounded-full flex items-center justify-center text-xs font-semibold shrink-0" style="background:#0057B8;color:white;">${i+1}</div><div class="flex-1">`;
                fields.forEach(f => {
                    let label = f.title, val = '-';
                    if (f.key === 'period') { val = formatDate(e.start_date)+(e.is_present?' - Present':(e.end_date?' - '+formatDate(e.end_date):'')); }
                    else if (f.key === 'type') { val = e.eligibility_type?.name||e.other_name||'-'; }
                    else if (f.key === 'year_graduated') { val = e[f.key]||'-'; }
                    else if (f.key === 'training_hours') { val = e[f.key] ? e[f.key]+' hours' : '-'; }
                    else if (['date_conducted','date_issued'].includes(f.key)) { val = formatDate(e[f.key]); }
                    else { val = e[f.key]||'-'; }
                    html += `<div class="text-xs mb-1"><span style="color:#64748b;">${label}:</span> <span style="color:#1e293b;font-weight:500;">${val}</span></div>`;
                });
                const fu = e.file_path ? `/storage/${e.file_path}` : null;
                if (fu) html += `<div class="text-xs mb-1"><span style="color:#64748b;">Document:</span> <a href="${fu}" target="_blank" style="color:#0057B8;text-decoration:none;font-size:13px;">View</a></div>`;
                html += `</div></div>`;
            });
        } else html += `<p style="color:#94a3b8;font-size:13px;font-style:italic;">No records found</p>`;
        html += `<div class="mt-5 pt-5" style="border-top:1px solid #e2e8f0;"><div class="text-sm font-semibold mb-3" style="color:#334155;">Evaluation</div>` +
            `<div class="flex gap-3 mb-3"><button type="button" class="px-5 py-[10px] rounded-[6px] text-xs font-medium cursor-pointer transition-all ${status==='qualified'?'bg-[#0057B8] text-white border-[#0057B8]':'bg-white text-[#64748b] border border-[#cbd5e1]'}" onclick="saveSectorEvaluation('${name}','qualified')">Qualified</button>` +
            `<button type="button" class="px-5 py-[10px] rounded-[6px] text-xs font-medium cursor-pointer transition-all ${status==='disqualified'?'bg-[#0057B8] text-white border-[#0057B8]':'bg-white text-[#64748b] border border-[#cbd5e1]'}" onclick="saveSectorEvaluation('${name}','disqualified')">Disqualified</button></div>` +
            `<textarea class="w-full px-3 py-[10px] border border-[#cbd5e1] rounded-[6px] text-xs resize-vertical" style="min-height:60px;" placeholder="Add remarks..." id="remarks_${name}">${ev?.remarks||''}</textarea></div>`;
        html += `</div></div>`;
        return html;
    }
    async function saveSectorEvaluation(sector, status) {
        try {
            const f = document.getElementById('generalStatusForm'), fd = new FormData(f);
            fd.append(`sectors[${sector}][status]`, status);
            const rEl = document.getElementById('remarks_'+sector);
            if (rEl && rEl.value) fd.append(`sectors[${sector}][remarks]`, rEl.value);
            const r = await fetch(`/hr/applications/${currentAppId}/sector-evaluation`, {
                method:'POST', headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]')?.content||'','Accept':'application/json'}, body: fd
            });
            if (r.ok) {
                sectorEvaluations[sector] = {status, remarks: rEl?.value||''};
                const si = ['education','training','experience','eligibility'].indexOf(sector);
                const card = document.getElementById('reviewModalBody').querySelectorAll('.border.border-hairline.rounded-\\[10px\\]')[si];
                if (card) {
                    const badge = card.querySelector('.text-xs.font-semibold');
                    if (badge) { badge.style.background = status==='qualified'?'#dcfce7':'#fee2e2'; badge.style.color = status==='qualified'?'#166534':'#991b1b'; badge.textContent = status==='qualified'?'Qualified':'Disqualified'; }
                    card.querySelectorAll('button').forEach(b => {
                        b.className = `px-5 py-[10px] rounded-[6px] text-xs font-medium cursor-pointer transition-all ${b.textContent.toLowerCase()===status?'bg-[#0057B8] text-white border-[#0057B8]':'bg-white text-[#64748b] border border-[#cbd5e1]'}`;
                    });
                }
                updateGeneralStatus();
                showToast(`${titleCase(sector)} evaluation saved!`);
            } else showToast('Error saving evaluation', true);
        } catch(e) { showToast('Error saving evaluation', true); }
    }
    function titleCase(s) { return s.charAt(0).toUpperCase()+s.slice(1); }
    function updateGeneralStatus() {
        const sectors = ['education','training','experience','eligibility'];
        let allQ = true, anyD = false, allE = true;
        sectors.forEach(s => {
            const ev = sectorEvaluations[s];
            if (!ev || (ev.status!=='qualified'&&ev.status!=='disqualified')) allE = false;
            if (ev && ev.status === 'disqualified') { anyD = true; allQ = false; }
            else if (!ev || ev.status !== 'qualified') allQ = false;
        });
        const ss = document.getElementById('generalStatusSelect'), cv = ss.value;
        if (anyD || !allE) ss.innerHTML = `<option value="pending" ${cv==='pending'?'selected':''}>Pending</option><option value="qualified" disabled ${cv==='qualified'?'selected':''}>Qualified</option><option value="disqualified" ${cv==='disqualified'?'selected':''}>Disqualified</option>`;
        else if (allQ) ss.innerHTML = `<option value="pending" ${cv==='pending'?'selected':''}>Pending</option><option value="qualified" ${cv==='qualified'?'selected':''}>Qualified</option><option value="disqualified" ${cv==='disqualified'?'selected':''}>Disqualified</option>`;
    }
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeReviewModal(); } });
    document.getElementById('reviewModal')?.addEventListener('click', function(e) { if (e.target === this) closeReviewModal(); });
</script>
@endpush
@endsection