<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationStatusUpdated;
use App\Models\Application;
use App\Models\JobPosting;
use App\Models\SectorEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ApplicationsController extends Controller
{
    private function checkHrRole()
    {
        if (auth()->user()->role !== 'hr') {
            abort(403, 'Unauthorized');
        }
    }

    public function index(Request $request)
    {
        $this->checkHrRole();

        $query = Application::with([
            'user', 
            'job.plantillaPosition',
            'sectorEvaluations'
        ]);

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->job_id && $request->job_id !== 'all') {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->orderBy('created_at', 'desc')->get();
        $jobPostings = JobPosting::with('plantillaPosition')
            ->where(function ($q) {
                $q->where('status', 'open')
                    ->orWhere('status', 'closed');
            })
            ->whereHas('applications')
            ->get();

        return view('hr.applications', compact('applications', 'jobPostings'));
    }

    public function show(Application $application)
    {
        $this->checkHrRole();
        
        $application->load(['user', 'job.plantillaPosition', 'educations', 'trainings', 'experiences', 'eligibilities', 'documents', 'sectorEvaluations']);
        
        return view('hr.application-detail', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->checkHrRole();

        $validated = $request->validate([
            'status' => 'required|in:pending,qualified,disqualified',
            'hr_notes' => 'nullable|string',
            'email_body' => 'nullable|string',
            'email_subject' => 'nullable|string|max:255',
        ]);

        $oldStatus = $application->status;

        $application->update([
            'status' => $validated['status'],
            'hr_notes' => $validated['hr_notes'] ?? null,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        $newStatus = $application->fresh()->status;

        $emailSent = false;
        $emailError = null;

        if (!empty($validated['email_body'])) {
            try {
                $subject = $validated['email_subject']
                    ?? ($newStatus === 'qualified'
                        ? "Congratulations — Initial Evaluation Result for " . ($application->job->plantillaPosition->position_name ?? 'Position') . " Position"
                        : "Update on your application for " . ($application->job->plantillaPosition->position_name ?? 'Position') . " Position");

                $recipientEmail = $application->user->email;

                Log::info('Attempting to send status email', [
                    'to' => $recipientEmail,
                    'subject' => $subject,
                    'status' => $newStatus,
                ]);

                Mail::send([], [], function ($message) use ($recipientEmail, $subject, $validated) {
                    $message->to($recipientEmail)
                        ->subject($subject)
                        ->html($validated['email_body']);
                });

                $emailSent = true;
            } catch (\Throwable $e) {
                $emailError = $e->getMessage();
                Log::error('Failed to send status update email: ' . $e->getMessage());
            }
        } elseif (in_array($newStatus, ['qualified', 'disqualified']) && $oldStatus !== $newStatus) {
            try {
                $recipientEmail = $application->user->email;

                Log::info('Attempting to send status update Mailable', [
                    'to' => $recipientEmail,
                    'status' => $newStatus,
                ]);

                Mail::to($recipientEmail)->send(
                    new ApplicationStatusUpdated($application->fresh())
                );

                $emailSent = true;
            } catch (\Throwable $e) {
                $emailError = $e->getMessage();
                Log::error('Failed to send status update Mailable: ' . $e->getMessage());
            }
        }

        $message = 'Application status updated successfully.';
        if ($emailSent) {
            $message .= ' Email sent to ' . ($application->user->email ?? 'applicant') . '.';
        }
        if ($emailError) {
            $message .= ' Email delivery failed: ' . $emailError;
        }

        return back()->with('success', $message);
    }

    public function emailPreview(Request $request, Application $application)
    {
        $this->checkHrRole();

        $status = $request->query('status', 'qualified');

        if (!in_array($status, ['qualified', 'disqualified'])) {
            return response()->json(['error' => 'Invalid status'], 422);
        }

        try {
            $application->load([
                'user.applicantProfile',
                'job.plantillaPosition',
                'educations',
                'trainings',
                'experiences',
                'eligibilities.eligibilityType',
                'sectorEvaluations',
            ]);

            $subject = $status === 'qualified'
                ? "Congratulations — Initial Evaluation Result for " . ($application->job?->plantillaPosition?->position_name ?? 'Position') . " Position"
                : "Update on your application for " . ($application->job?->plantillaPosition?->position_name ?? 'Position') . " Position";

            $text = $this->buildPlainTextEmail($application, $status);

            return response()->json([
                'subject' => $subject,
                'text' => $text,
            ]);
        } catch (\Throwable $e) {
            Log::error('Email preview failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function buildEmail(Request $request, Application $application)
    {
        $this->checkHrRole();

        $validated = $request->validate([
            'status' => 'required|in:qualified,disqualified',
            'body_text' => 'required|string',
        ]);

        try {
            $application->load([
                'user.applicantProfile',
                'job.plantillaPosition',
                'educations',
                'trainings',
                'experiences',
                'eligibilities.eligibilityType',
                'sectorEvaluations',
            ]);

            $mailable = new ApplicationStatusUpdated($application);
            $viewData = $mailable->content()->with ?? [];
            $viewData['status'] = $validated['status'];
            $viewData['bodyText'] = $validated['body_text'];

            $html = view('emails.application-status-updated', $viewData)->render();

            return response()->json(['html' => $html]);
        } catch (\Throwable $e) {
            Log::error('Build email failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function buildPlainTextEmail(Application $application, string $status): string
    {
        $user = $application->user;
        $position = $application->job->plantillaPosition;
        $positionName = $position?->position_name ?? 'Position';
        $itemNo = $position?->plantilla_item_no ?? '—';
        $officeName = config('deped.office_name');
        $officeAddress = config('deped.office_address');
        $applicantName = trim("{$user->first_name} {$user->middle_name} {$user->last_name} {$user->extension_name}");
        $applicantAddress = $user->applicantProfile
            ? trim(implode(', ', array_filter([
                $user->applicantProfile->barangay,
                $user->applicantProfile->city ?? $user->applicantProfile->municipality,
                $user->applicantProfile->province,
                $user->applicantProfile->zip_code,
            ])))
            : '—';
        $date = now()->format('F d, Y');
        $applicationCode = $application->application_code;
        $telephone = config('deped.telephone');
        $email = config('deped.email');
        $hrmoName = config('deped.hrmo_name');
        $hrmoPosition = config('deped.hrmo_position');

        $evals = $application->sectorEvaluations->keyBy('sector');
        $sectorLabels = ['Education', 'Experience', 'Training', 'Eligibility'];
        $sectorKeys = ['education', 'experience', 'training', 'eligibility'];

        $sectorLines = '';
        foreach ($sectorKeys as $i => $key) {
            $e = $evals->get($key);
            $required = $e && $key === 'education'
                ? $application->job->required_education ?? '—'
                : ($e && $key === 'experience'
                    ? $application->job->required_experience ?? '—'
                    : ($e && $key === 'training'
                        ? $application->job->required_training ?? '—'
                        : ($e && $key === 'eligibility'
                            ? $application->job->required_eligibility ?? '—'
                            : '—')));
            $qualifications = $e && $key === 'education'
                ? $application->educations->map(fn($e) => trim("{$e->school_name}" . ($e->course ? " - {$e->course}" : '') . ($e->year_graduated ? " ({$e->year_graduated})" : '')))->filter()->implode("\n    ")
                : ($e && $key === 'experience'
                    ? $application->experiences->map(fn($e) => trim("{$e->position} at {$e->employer}" . ($e->start_date ? ' (' . optional($e->start_date)->format('Y') . ' - ' . ($e->is_present ? 'Present' : optional($e->end_date)->format('Y')) . ')' : '')))->filter()->implode("\n    ")
                    : ($e && $key === 'training'
                        ? $application->trainings->map(fn($t) => trim("{$t->training_title}" . ($t->training_hours ? " ({$t->training_hours} hrs)" : '')))->filter()->implode("\n    ")
                        : ($e && $key === 'eligibility'
                            ? $application->eligibilities->map(fn($e) => trim(($e->eligibilityType?->name ?? $e->other_name ?? 'Eligibility') . ($e->license_no ? " (License: {$e->license_no})" : '')))->filter()->implode("\n    ")
                            : '—')));
            $sectorStatus = ucfirst($e?->status ?? 'pending');
            $remarks = $e?->remarks ? "  Remarks: {$e->remarks}" : '';

            $sectorLines .= strtoupper($sectorLabels[$i]) . "\n"
                . "  Required: {$required}\n"
                . "  Your Qualifications: {$qualifications}\n"
                . "  Status: {$sectorStatus}{$remarks}\n\n";
        }

        $intro = $status === 'qualified'
            ? "Congratulations!\n\nWe are pleased to inform you that based on the initial evaluation, we have found your qualifications to be substantial vis-à-vis the Civil Service Commission (CSC) approved Qualification Standards (QS) of {$positionName} position under {$officeName}. Below are the results of the initial evaluation conducted by the undersigned dated {$date}:"
            : "Please be informed of the results of the initial evaluation of your qualifications vis-à-vis the Civil Service Commission (CSC) approved-Qualification Standards (QS) of {$positionName} position under {$officeName}, as follows:";

        if ($status === 'qualified') {
            $bodyParas = "Please be advised of your assigned application code {$applicationCode} which shall be used as you proceed with the next stage of the selection process. You may refer to the official issuances of {$officeName} for additional announcements in this regard. For inquiries, you may communicate with {$officeName} at {$telephone} or {$email}.\n\n"
                . "Thank you.";
        } else {
            $bodyParas = "While your qualifications made a favorable impression, we regret to inform you that you did not meet the minimum QS set for {$positionName} position. You may, however, continue to submit job applications in response to other vacancy announcements that we publish at www.csc.gov.ph/careers, DepEd bulletin boards, and official website (you may insert online links of other job portals, if necessary).\n\n"
                . "The results of the initial evaluation shall be released and posted for transparency purposes. You may refer to your assigned application code {$applicationCode} in the official posting of the results.\n\n"
                . "Thank you and we wish you the best of luck in your future success.";
        }

        return "ANNEX " . ($status === 'qualified' ? 'E' : 'F') . "\n\n"
            . "Republic of the Philippines\n"
            . "Department of Education\n"
            . "{$officeName}\n"
            . "PERSONNEL DIVISION\n\n"
            . "{$date}\n\n"
            . "{$applicantName}\n"
            . "{$applicantAddress}\n\n"
            . "Dear {$applicantName},\n\n"
            . "{$intro}\n\n"
            . "POSITION APPLIED FOR: {$positionName}\n"
            . "Plantilla Item No.: {$itemNo}\n\n"
            . "QUALIFICATIONS COMPARISON:\n\n"
            . "{$sectorLines}"
            . "{$bodyParas}\n\n"
            . "Very truly yours,\n\n\n"
            . "{$hrmoName}\n"
            . "{$hrmoPosition}\n\n"
            . "{$officeAddress}\n"
            . "Tel. Nos.: {$telephone} | Email: {$email}";
    }

    public function storeSectorEvaluation(Request $request, Application $application)
    {
        $this->checkHrRole();

        $sectors = $request->input('sectors', []);
        
        foreach (['education', 'training', 'experience', 'eligibility'] as $sector) {
            if (isset($sectors[$sector])) {
                $sectorData = $sectors[$sector];
                SectorEvaluation::updateOrCreate(
                    [
                        'application_id' => $application->id,
                        'sector' => $sector,
                    ],
                    [
                        'status' => $sectorData['status'] ?? 'disqualified',
                        'remarks' => $sectorData['remarks'] ?? null,
                        'evaluated_by' => auth()->id(),
                        'evaluated_at' => now(),
                    ]
                );
            }
        }

        return back()->with('success', 'Sector evaluations saved successfully.');
    }

    public function getApplicationDetails(Application $application)
    {
        $this->checkHrRole();
        
        $application->load([
            'user',
            'job.plantillaPosition',
            'educations',
            'trainings',
            'experiences',
            'eligibilities',
            'documents.documentType',
            'sectorEvaluations'
        ]);

        return response()->json([
            'application' => $application,
            'sectorEvaluations' => $application->sectorEvaluations->keyBy('sector'),
        ]);
    }
}