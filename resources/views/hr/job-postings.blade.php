@extends('layouts.hr')
@section('title', 'Job Postings - DEPED Region V Recruitment')
@push('styles')
<style>
.file-input-wrapper { position: relative; }
.file-input-wrapper input[type="file"] { position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; }
.modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; padding: 20px; }
.modal-overlay.show { display: flex; }
.confirm-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1100; padding: 20px; }
.confirm-overlay.show { display: flex; }
</style>
@endpush
@section('content')
<div class="flex items-center justify-between mb-lg">
    <h1 class="text-2xl font-semibold">Job Postings</h1>
    <button type="button" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer no-underline inline-flex items-center gap-2 h-10 hover:bg-primary-active transition-colors" onclick="openModal()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Create New Job
    </button>
</div>

<div class="flex gap-3 mb-5">
    <input type="text" class="flex-1 h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink focus:outline-none focus:border-primary focus:border-2 focus:px-[15px] transition-colors" id="searchInput" placeholder="Search by position, department..." onkeyup="filterTable()">
</div>

<div class="flex gap-2 mb-5">
    <button type="button" class="filter-tab active px-base py-2 text-sm font-medium border-none bg-primary text-white rounded-md cursor-pointer" onclick="filterStatus('all')">All</button>
    <button type="button" class="filter-tab px-base py-2 text-sm font-medium border-none bg-surface-strong text-body rounded-md cursor-pointer" onclick="filterStatus('draft')">Draft</button>
    <button type="button" class="filter-tab px-base py-2 text-sm font-medium border-none bg-surface-strong text-body rounded-md cursor-pointer" onclick="filterStatus('open')">Open</button>
    <button type="button" class="filter-tab px-base py-2 text-sm font-medium border-none bg-surface-strong text-body rounded-md cursor-pointer" onclick="filterStatus('closed')">Closed</button>
</div>

<div class="bg-surface-card border border-hairline rounded-lg overflow-hidden">
    <table class="w-full border-collapse" id="jobTable">
        <thead>
            <tr>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Position</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Department</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Salary Grade</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Monthly Salary</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Status</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Deadline</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Applications</th>
                <th class="text-left px-base py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline bg-canvas-soft">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobPostings as $job)
            <tr data-status="{{ $job->status }}" class="hover:bg-canvas-soft transition-colors">
                <td class="px-base py-[14px] text-sm border-b border-hairline"><strong>{{ $job->plantillaPosition->position_name ?? 'N/A' }}</strong></td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $job->plantillaPosition->department ?? 'N/A' }}</td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">SG-{{ $job->plantillaPosition->salary_grade ?? '-' }}</td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">PHP {{ number_format($job->monthly_salary, 2) }}</td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">
                    @php
                        $sc = ['open' => 'status-open', 'draft' => 'status-draft', 'closed' => 'status-closed'];
                        $s = $sc[$job->status] ?? 'status-draft';
                    @endphp
                    <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background: var(--color-{{ $s }}-bg); color: var(--color-{{ $s }}-text);">{{ ucfirst($job->status) }}</span>
                </td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $job->deadline->format('M d, Y') }}</td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">{{ $job->applications->count() }}</td>
                <td class="px-base py-[14px] text-sm border-b border-hairline">
                    <div class="flex gap-2">
                        <button type="button" class="bg-surface-card text-ink text-sm font-medium px-base py-2 border border-hairline-strong rounded-md cursor-pointer no-underline inline-flex items-center gap-[6px] h-9 hover:bg-surface-strong transition-colors" onclick="editJob({{ $job->id }})">Edit</button>
                        <button type="button" class="bg-[#fee2e2] text-semantic-error-strong text-xs font-medium px-3 py-[6px] border-none rounded-md cursor-pointer hover:bg-[#fecaca] transition-colors" onclick="confirmDelete({{ $job->id }})">Delete</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-10 text-sm">No job postings found. Create your first job posting!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create/Edit Modal -->
<div class="modal-overlay" id="jobModal">
    <div class="bg-white rounded-lg w-full max-w-[700px] max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between px-lg py-5 border-b border-hairline">
            <h2 class="text-lg font-semibold" id="modalTitle">Create New Job Posting</h2>
            <button type="button" class="bg-none border-none text-2xl cursor-pointer text-muted hover:text-ink transition-colors" onclick="closeModal()">&times;</button>
        </div>
        <form method="POST" id="jobForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id" id="jobId" value="">
            <div class="p-lg">
                <div class="grid grid-cols-2 gap-base mb-base">
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Department <span class="text-semantic-error-strong">*</span></label>
                        <select class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" id="departmentSelect" name="department" onchange="loadPositions()">
                            <option value="">Select Department</option>
                        </select>
                    </div>
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Plantilla Position <span class="text-semantic-error-strong">*</span></label>
                        <select class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" id="positionSelect" name="plantilla_position_id" onchange="loadPositionDetails()" required>
                            <option value="">Select Position</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-base mb-4">
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Position Name</label>
                        <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans disabled:bg-canvas-soft disabled:text-muted focus:outline-none focus:border-primary focus:border-2" id="positionName" disabled>
                    </div>
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Position Code</label>
                        <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans disabled:bg-canvas-soft disabled:text-muted focus:outline-none focus:border-primary focus:border-2" id="positionCode" disabled>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-base mb-4">
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Salary Grade</label>
                        <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans disabled:bg-canvas-soft disabled:text-muted focus:outline-none focus:border-primary focus:border-2" id="salaryGrade" disabled>
                    </div>
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Monthly Salary <span class="text-semantic-error-strong">*</span></label>
                        <input type="number" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="monthly_salary" id="monthlySalary" required min="0" step="0.01">
                    </div>
                </div>
                <div class="mb-base">
                    <label class="block text-sm font-medium text-ink mb-[6px]">Description</label>
                    <textarea class="w-full px-base py-3 text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans resize-vertical focus:outline-none focus:border-primary focus:border-2" name="description" id="jobDescription" rows="3" placeholder="Enter job description..."></textarea>
                </div>
                <div class="text-sm font-semibold text-body mb-3 pb-2 border-b border-hairline">Qualification Standards</div>
                <div class="mb-base">
                    <label class="block text-sm font-medium text-ink mb-[6px]">Required Education</label>
                    <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="required_education" id="requiredEducation" placeholder="e.g., Bachelor's Degree in Education">
                </div>
                <div class="mb-base">
                    <label class="block text-sm font-medium text-ink mb-[6px]">Required Training</label>
                    <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="required_training" id="requiredTraining" placeholder="e.g., 40 hours of relevant training">
                </div>
                <div class="mb-base">
                    <label class="block text-sm font-medium text-ink mb-[6px]">Required Experience</label>
                    <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="required_experience" id="requiredExperience" placeholder="e.g., 2 years of teaching experience">
                </div>
                <div class="mb-base">
                    <label class="block text-sm font-medium text-ink mb-[6px]">Required Eligibility</label>
                    <input type="text" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="required_eligibility" id="requiredEligibility" placeholder="e.g., RA 1080 (LET)">
                </div>
                <div class="text-sm font-semibold text-body mb-3 pb-2 border-b border-hairline">Requirements (Documents Required from Applicants)</div>
                <div class="grid grid-cols-2 gap-[10px]" id="requirementsCheckboxes"></div>
                <div class="text-sm font-semibold text-body mb-3 pb-2 border-b border-hairline mt-lg">Other Details</div>
                <div class="grid grid-cols-2 gap-base mb-4">
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Deadline <span class="text-semantic-error-strong">*</span></label>
                        <input type="datetime-local" class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="deadline" id="deadline" required>
                    </div>
                    <div class="mb-base">
                        <label class="block text-sm font-medium text-ink mb-[6px]">Status <span class="text-semantic-error-strong">*</span></label>
                        <select class="w-full h-11 px-base text-sm border border-hairline-strong rounded-md bg-surface-card text-ink font-sans focus:outline-none focus:border-primary focus:border-2" name="status" id="jobStatus" required>
                            <option value="draft">Draft</option>
                            <option value="open" selected>Open</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                </div>
                <div class="mb-base">
                    <label class="block text-sm font-medium text-ink mb-[6px]">Job Description PDF (Max 20MB, PDF only)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="job_description_pdf" id="jobDescriptionPdf" accept=".pdf" onchange="updateFileDisplay(this)">
                        <div class="flex items-center gap-[10px] px-base py-[10px] border border-dashed border-hairline-strong rounded-md bg-canvas-soft text-sm text-body cursor-pointer" id="fileDisplay">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                            <span>Click to upload PDF or drag and drop</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 px-lg py-base border-t border-hairline">
                <button type="button" class="bg-surface-card text-ink text-sm font-medium px-base py-2 border border-hairline-strong rounded-md cursor-pointer hover:bg-surface-strong transition-colors" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors">Save Job Posting</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation -->
<div class="confirm-overlay" id="deleteConfirm">
    <div class="bg-white rounded-lg p-lg max-w-[400px] text-center shadow-lg" onclick="event.stopPropagation()">
        <h3 class="text-lg font-semibold mb-2">Delete Job Posting</h3>
        <p class="text-sm text-body mb-lg">Are you sure you want to delete this job posting? This action cannot be undone.</p>
        <div class="flex gap-3 justify-center">
            <button type="button" class="px-6 py-[10px] rounded-md text-sm font-medium cursor-pointer border-none bg-surface-strong text-ink" onclick="hideDeleteConfirm()">Cancel</button>
            <form method="POST" id="deleteForm" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-[10px] rounded-md text-sm font-medium cursor-pointer border-none bg-semantic-error-strong text-white">Delete</button>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    let currentFilter = 'all';
    let jobData = {!! $jobPostings->toJson() !!};
    document.addEventListener('DOMContentLoaded', function() { loadDepartments(); loadDocumentTypes(); });
    function loadDepartments() {
        return fetch('{{ route("hr.job-postings.departments") }}')
            .then(r => r.json())
            .then(data => {
                const sel = document.getElementById('departmentSelect');
                data.forEach(d => { const o = document.createElement('option'); o.value = d; o.textContent = d; sel.appendChild(o); });
            });
    }
    function loadPositions() {
        const dept = document.getElementById('departmentSelect').value;
        const sel = document.getElementById('positionSelect');
        sel.innerHTML = '<option value="">Select Position</option>';
        if (!dept) return;
        fetch('{{ route("hr.job-postings.positions") }}?department=' + encodeURIComponent(dept))
            .then(r => r.json()).then(data => {
                data.forEach(p => {
                    const o = document.createElement('option');
                    o.value = p.id; o.textContent = p.position_name; o.dataset.code = p.position_code; o.dataset.grade = p.salary_grade;
                    sel.appendChild(o);
                });
            });
    }
    function loadPositionDetails() {
        const id = document.getElementById('positionSelect').value;
        const opt = document.getElementById('positionSelect').selectedOptions[0];
        document.getElementById('positionName').value = id ? opt.textContent : '';
        document.getElementById('positionCode').value = id ? (opt.dataset.code || '') : '';
        document.getElementById('salaryGrade').value = id ? ('SG-' + (opt.dataset.grade || '')) : '';
    }
    function loadDocumentTypes(preselectedIds = []) {
        fetch('{{ route("hr.job-postings.document-types") }}')
            .then(r => r.json()).then(data => {
                const c = document.getElementById('requirementsCheckboxes');
                c.innerHTML = '';
                data.forEach(d => {
                    const checked = preselectedIds.map(String).includes(String(d.id));
                    c.innerHTML += `<div class="flex items-center gap-2"><input type="checkbox" id="doc_${d.id}" name="requirements[]" value="${d.id}" ${checked ? 'checked' : ''} class="w-4 h-4 accent-primary"><label for="doc_${d.id}" class="text-sm text-body cursor-pointer">${d.name}${d.is_required ? ' *' : ''}</label></div>`;
                });
            });
    }
    function openModal() {
        document.getElementById('modalTitle').textContent = 'Create New Job Posting';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('jobForm').action = '{{ route("hr.job-postings") }}';
        document.getElementById('jobId').value = '';
        document.getElementById('jobForm').reset();
        document.getElementById('fileDisplay').innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg><span>Click to upload PDF or drag and drop</span>';
        loadDepartments(); loadDocumentTypes([]);
        document.getElementById('jobModal').classList.add('show');
    }
    function closeModal() { document.getElementById('jobModal').classList.remove('show'); }
    function editJob(id) {
        const job = jobData.find(j => j.id === id);
        if (!job) return;
        document.getElementById('modalTitle').textContent = 'Edit Job Posting';
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('jobForm').action = '/hr/job-postings/' + id;
        document.getElementById('jobId').value = id;
        loadDepartments().then(() => {
            document.getElementById('departmentSelect').value = job.plantilla_position?.department;
            return fetch('{{ route("hr.job-postings.positions") }}?department=' + encodeURIComponent(job.plantilla_position?.department || ''));
        }).then(r => r.json()).then(positions => {
            const sel = document.getElementById('positionSelect');
            sel.innerHTML = '<option value="">Select Position</option>';
            positions.forEach(p => {
                const o = document.createElement('option');
                o.value = p.id; o.textContent = p.position_name; o.dataset.code = p.position_code; o.dataset.grade = p.salary_grade;
                if (p.id === job.plantilla_position_id) o.selected = true;
                sel.appendChild(o);
            });
            loadPositionDetails();
        });
        document.getElementById('monthlySalary').value = job.monthly_salary;
        document.getElementById('jobDescription').value = job.description || '';
        document.getElementById('requiredEducation').value = job.required_education || '';
        document.getElementById('requiredTraining').value = job.required_training || '';
        document.getElementById('requiredExperience').value = job.required_experience || '';
        document.getElementById('requiredEligibility').value = job.required_eligibility || '';
        document.getElementById('deadline').value = job.deadline ? job.deadline.slice(0, 16) : '';
        document.getElementById('jobStatus').value = job.status;
        loadDocumentTypes(job.requirements || []);
        document.getElementById('jobModal').classList.add('show');
    }
    function confirmDelete(id) { document.getElementById('deleteForm').action = '/hr/job-postings/' + id; document.getElementById('deleteConfirm').classList.add('show'); }
    function hideDeleteConfirm() { document.getElementById('deleteConfirm').classList.remove('show'); }
    function updateFileDisplay(input) {
        const d = document.getElementById('fileDisplay');
        if (input.files && input.files[0]) {
            d.className = 'flex items-center gap-[10px] px-base py-[10px] border border-solid border-hairline-strong rounded-md bg-surface-card text-sm text-body cursor-pointer';
            d.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg><span>' + input.files[0].name + '</span>';
        }
    }
    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#jobTable tbody tr').forEach(r => r.style.display = r.textContent.toLowerCase().includes(search) ? '' : 'none');
    }
    function filterStatus(status) {
        currentFilter = status;
        document.querySelectorAll('.filter-tab').forEach(t => t.className = 'filter-tab px-base py-2 text-sm font-medium border-none rounded-md cursor-pointer ' + (t === event.target ? 'bg-primary text-white' : 'bg-surface-strong text-body'));
        document.querySelectorAll('#jobTable tbody tr').forEach(r => r.style.display = (status === 'all' || r.dataset.status === status) ? '' : 'none');
    }
    @if(session('success'))
    showToast('{{ session("success") }}');
    @endif
    @if($errors->any())
    showToast('{{ $errors->first() }}', true);
    @endif
    document.getElementById('jobModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });
    document.getElementById('deleteConfirm').addEventListener('click', function(e) { if (e.target === this) hideDeleteConfirm(); });
</script>
@endpush
@endsection