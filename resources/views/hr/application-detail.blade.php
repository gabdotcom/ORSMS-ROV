<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>Application Details - DEPED Region V Recruitment</title>
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
                --color-canvas-soft: #f5f5f7;
                --color-surface-card: #ffffff;
                --color-surface-strong: #f0f0f3;
                --color-semantic-success: #16a34a;
                --color-semantic-warning: #ab6400;
                --color-semantic-error: #dc2626;
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
            .main-content { max-width: 1200px; margin: 0 auto; padding: 32px; }
            .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-start; }
            .page-title { font-size: 24px; font-weight: 600; margin-bottom: 8px; }
            .page-subtitle { font-size: 14px; color: var(--color-body); }
            .back-link { color: var(--color-primary); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
            .back-link:hover { text-decoration: underline; }
            .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; }
            .card { background: var(--color-surface-card); border: 1px solid var(--color-hairline); border-radius: var(--rounded-lg); padding: 24px; }
            .card-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--color-hairline); }
            .info-row { display: flex; padding: 8px 0; border-bottom: 1px solid var(--color-hairline); }
            .info-row:last-child { border-bottom: none; }
            .info-label { width: 150px; color: var(--color-muted); font-size: 13px; }
            .info-value { flex: 1; font-size: 14px; }
            .badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
            .badge-pending { background: #fef3c7; color: #92400e; }
            .badge-qualified { background: #dcfce7; color: #166534; }
            .badge-disqualified { background: #fee2e2; color: #991b1b; }
            .form-group { margin-bottom: 16px; }
            .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; }
            .form-select, .form-textarea {
                width: 100%;
                padding: 10px 12px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                font-size: 14px;
                font-family: var(--font-sans);
            }
            .form-textarea { min-height: 100px; resize: vertical; }
            .btn-primary {
                background: var(--color-primary);
                color: white;
                font-size: 14px;
                font-weight: 500;
                padding: 10px 20px;
                border-radius: var(--rounded-md);
                border: none;
                cursor: pointer;
            }
            .btn-primary:hover { background: var(--color-primary-hover); }
            .entry-item { padding: 12px; background: var(--color-canvas-soft); border-radius: var(--rounded-md); margin-bottom: 12px; }
            .entry-item:last-child { margin-bottom: 0; }
            .entry-title { font-weight: 500; font-size: 14px; margin-bottom: 4px; }
            .entry-detail { font-size: 13px; color: var(--color-body); }
            .full-width { grid-column: 1 / -1; }
            .alert { padding: 12px 16px; border-radius: var(--rounded-md); margin-bottom: 20px; font-size: 14px; }
            .alert-success { background: #dcfce7; color: #166534; }
            .sector-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 16px; }
            .sector-card { padding: 12px; border: 1px solid var(--color-hairline); border-radius: var(--rounded-md); text-align: center; cursor: pointer; transition: all 0.2s; }
            .sector-card:hover { border-color: var(--color-primary); }
            .sector-card.active { border-color: var(--color-primary); background: #f0f7ff; }
            .sector-name { font-size: 12px; color: var(--color-muted); text-transform: uppercase; margin-bottom: 4px; }
            .sector-status { font-size: 14px; font-weight: 600; }
            .sector-status.qualified { color: #16a34a; }
            .sector-status.disqualified { color: #dc2626; }
            .sector-status.pending { color: #ab6400; }
            .badge-qualified { background: #dcfce7; color: #166534; }
            .badge-disqualified { background: #fee2e2; color: #991b1b; }
            .badge-pending { background: #fef3c7; color: #92400e; }
            .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
            .modal-overlay.show { display: flex; }
            .modal-content { background: white; border-radius: var(--rounded-lg); padding: 24px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto; }
            .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
            .modal-title { font-size: 18px; font-weight: 600; }
            .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: var(--color-body); }
            .sector-form { padding: 16px; border: 1px solid var(--color-hairline); border-radius: var(--rounded-md); margin-bottom: 16px; }
            .sector-form:last-child { margin-bottom: 0; }
            .sector-form-title { font-size: 14px; font-weight: 600; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
            .sector-form-title .badge { font-size: 10px; padding: 2px 8px; }
            .radio-group { display: flex; gap: 16px; margin-bottom: 12px; }
            .radio-label { display: flex; align-items: center; gap: 6px; font-size: 14px; cursor: pointer; }
            .warning-box { background: #fef3c7; border: 1px solid #f59e0b; border-radius: var(--rounded-md); padding: 12px; font-size: 13px; color: #92400e; margin-bottom: 16px; }
            @media (max-width: 768px) {
                .sector-grid { grid-template-columns: repeat(2, 1fr); }
            }
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
                <a href="{{ route('hr.applications') }}">Back to Applications</a>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="page-header">
                <div>
                    <h1 class="page-title">Application: {{ $application->application_code }}</h1>
                    <p class="page-subtitle">
                        {{ $application->user->first_name ?? '-' }} {{ $application->user->last_name ?? '' }} - 
                        {{ $application->job->plantillaPosition->position_name ?? '-' }}
                    </p>
                </div>
                <span class="badge badge-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
            </div>

            <div class="grid">
                <!-- Personal Information -->
                <div class="card">
                    <h2 class="card-title">Personal Information</h2>
                    <div class="info-row">
                        <span class="info-label">Name</span>
                        <span class="info-value">{{ $application->user->first_name ?? '-' }} {{ $application->user->middle_name ?? '' }} {{ $application->user->last_name ?? '' }} {{ $application->user->extension_name ?? '' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $application->user->email ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Submitted</span>
                        <span class="info-value">{{ $application->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    @if($application->reviewed_at)
                    <div class="info-row">
                        <span class="info-label">Reviewed</span>
                        <span class="info-value">{{ $application->reviewed_at->format('M d, Y h:i A') }}</span>
                    </div>
                    @endif
                </div>

                <!-- Job Information -->
                <div class="card">
                    <h2 class="card-title">Job Information</h2>
                    <div class="info-row">
                        <span class="info-label">Position</span>
                        <span class="info-value">{{ $application->job->plantillaPosition->position_name ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Department</span>
                        <span class="info-value">{{ $application->job->plantillaPosition->department ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Item No.</span>
                        <span class="info-value">{{ $application->job->plantillaPosition->plantilla_item_no ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Salary Grade</span>
                        <span class="info-value">SG-{{ $application->job->plantillaPosition->salary_grade ?? '-' }}</span>
                    </div>
                </div>

                <!-- Education -->
                @if($application->educations->count() > 0)
                <div class="card">
                    <h2 class="card-title">Education</h2>
                    @foreach($application->educations as $edu)
                    <div class="entry-item">
                        <div class="entry-title">{{ $edu->level }}</div>
                        <div class="entry-detail">{{ $edu->school_name }}{{ $edu->course ? ' - ' . $edu->course : '' }} ({{ $edu->year_graduated }})</div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Work Experience -->
                @if($application->experiences->count() > 0)
                <div class="card">
                    <h2 class="card-title">Work Experience</h2>
                    @foreach($application->experiences as $exp)
                    <div class="entry-item">
                        <div class="entry-title">{{ $exp->position }} at {{ $exp->employer }}</div>
                        <div class="entry-detail">
                            {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }} - 
                            {{ $exp->is_present ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '') }}
                            {{ $exp->sector ? ' | ' . $exp->sector : '' }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Training -->
                @if($application->trainings->count() > 0)
                <div class="card">
                    <h2 class="card-title">Training</h2>
                    @foreach($application->trainings as $train)
                    <div class="entry-item">
                        <div class="entry-title">{{ $train->training_title }}</div>
                        <div class="entry-detail">
                            {{ $train->training_hours ? $train->training_hours . ' hours' : '' }}
                            {{ $train->date_conducted ? ' | ' . \Carbon\Carbon::parse($train->date_conducted)->format('M d, Y') : '' }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Eligibility -->
                @if($application->eligibilities->count() > 0)
                <div class="card">
                    <h2 class="card-title">Eligibility</h2>
                    @foreach($application->eligibilities as $elig)
                    <div class="entry-item">
                        <div class="entry-title">{{ $elig->eligibilityType->name ?? 'Other' }}</div>
                        <div class="entry-detail">
                            {{ $elig->license_no ? 'License: ' . $elig->license_no : '' }}
                            {{ $elig->date_issued ? ' | Issued: ' . \Carbon\Carbon::parse($elig->date_issued)->format('M d, Y') : '' }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Sector Evaluations Summary -->
                @php
                $sectors = ['education', 'training', 'experience', 'eligibility'];
                $sectorEvals = $application->sectorEvaluations->keyBy('sector');
                $allQualified = $sectorEvals->every(fn($e) => $e->status === 'qualified');
                $anyDisqualified = $sectorEvals->contains(fn($e) => $e->status === 'disqualified');
                @endphp
                <div class="card full-width">
                    <h2 class="card-title">Sector Evaluations</h2>
                    <div class="sector-grid">
                        @foreach($sectors as $sector)
                        <div class="sector-card" onclick="openSectorModal('{{ $sector }}')">
                            <div class="sector-name">{{ ucfirst($sector) }}</div>
                            <div class="sector-status {{ $sectorEvals[$sector]->status ?? 'pending' }}">
                                {{ ucfirst($sectorEvals[$sector]->status ?? 'pending') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-primary" onclick="openSectorModal()">Evaluate Sectors</button>
                </div>

                <!-- Update Status -->
                <div class="card full-width">
                    <h2 class="card-title">Update Application Status</h2>
                    @if($anyDisqualified)
                    <div class="warning-box">
                        <strong>Note:</strong> This application has one or more disqualified sectors. The general status cannot be set to "Qualified".
                    </div>
                    @elseif(!$allQualified && $application->status !== 'pending')
                    <div class="warning-box">
                        <strong>Note:</strong> All sectors must be "Qualified" before you can set this application as "Qualified".
                    </div>
                    @endif
                    <form method="POST" action="{{ route('hr.applications.update-status', $application->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid" style="margin-bottom: 16px;">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required {{ $anyDisqualified ? 'disabled' : '' }}>
                                    <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="qualified" {{ $application->status === 'qualified' ? 'selected' : '' }} {{ $anyDisqualified || !$allQualified ? 'disabled' : '' }}>Qualified</option>
                                    <option value="disqualified" {{ $application->status === 'disqualified' ? 'selected' : '' }}>Disqualified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Notes (Optional)</label>
                                <textarea name="hr_notes" class="form-textarea" placeholder="Add notes about this application...">{{ $application->hr_notes ?? '' }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary" {{ $anyDisqualified ? 'disabled' : '' }}>Update Status</button>
                    </form>
                </div>
            </div>
        </main>

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
                    <div class="sector-form" id="sector-form-{{ $sector }}">
                        <div class="sector-form-title">
                            {{ ucfirst($sector) }}
                            @if($eval)
                            <span class="badge badge-{{ $eval->status }}">{{ $eval->status }}</span>
                            @endif
                        </div>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="sectors[{{ $sector }}][status]" value="qualified" {{ $eval?->status === 'qualified' ? 'checked' : '' }}> Qualified
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="sectors[{{ $sector }}][status]" value="disqualified" {{ $eval?->status === 'disqualified' ? 'checked' : '' }}> Disqualified
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="sectors[{{ $sector }}][status]" value="pending" {{ !$eval || $eval->status === 'pending' ? 'checked' : '' }}> Pending
                            </label>
                        </div>
                        <textarea name="sectors[{{ $sector }}][remarks]" class="form-textarea" placeholder="Remarks for {{ $sector }}...">{{ $eval?->remarks ?? '' }}</textarea>
                    </div>
                    @endforeach
                    <button type="submit" class="btn-primary" style="width: 100%;">Save Evaluations</button>
                </form>
            </div>
        </div>

        <script>
            function openSectorModal() {
                document.getElementById('sectorModal').classList.add('show');
            }
            function closeSectorModal() {
                document.getElementById('sectorModal').classList.remove('show');
            }
            document.getElementById('sectorModal').addEventListener('click', function(e) {
                if (e.target === this) closeSectorModal();
            });
        </script>
    </body>
</html>