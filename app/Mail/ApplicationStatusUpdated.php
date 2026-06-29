<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;
    public array $sectorData;
    public string $evaluationDate;

    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->evaluationDate = now()->format('F d, Y');

        $application->load([
            'user.applicantProfile',
            'job.plantillaPosition',
            'educations',
            'trainings',
            'experiences',
            'eligibilities.eligibilityType',
            'sectorEvaluations',
        ]);

        $evals = $application->sectorEvaluations->keyBy('sector');

        $this->sectorData = [
            'education' => [
                'required_qs' => $application->job->required_education ?? '—',
                'qualifications' => $this->formatEducation($application),
                'status' => $evals->get('education')?->status ?? 'pending',
                'remarks' => $evals->get('education')?->remarks,
            ],
            'experience' => [
                'required_qs' => $application->job->required_experience ?? '—',
                'qualifications' => $this->formatExperience($application),
                'status' => $evals->get('experience')?->status ?? 'pending',
                'remarks' => $evals->get('experience')?->remarks,
            ],
            'training' => [
                'required_qs' => $application->job->required_training ?? '—',
                'qualifications' => $this->formatTraining($application),
                'status' => $evals->get('training')?->status ?? 'pending',
                'remarks' => $evals->get('training')?->remarks,
            ],
            'eligibility' => [
                'required_qs' => $application->job->required_eligibility ?? '—',
                'qualifications' => $this->formatEligibility($application),
                'status' => $evals->get('eligibility')?->status ?? 'pending',
                'remarks' => $evals->get('eligibility')?->remarks,
            ],
        ];
    }

    public function envelope(): Envelope
    {
        $position = $this->application->job->plantillaPosition->position_name ?? 'Position';

        return new Envelope(
            subject: $this->application->status === 'qualified'
                ? "Congratulations — Initial Evaluation Result for {$position} Position"
                : "Update on your application for {$position} Position",
        );
    }

    public function content(): Content
    {
        $app = $this->application;
        $user = $app->user;
        $position = $app->job->plantillaPosition;

        return new Content(
            view: 'emails.application-status-updated',
            with: [
                'positionName' => $position?->position_name ?? 'Position',
                'plantillaItemNo' => $position?->plantilla_item_no ?? '—',
                'date' => now()->format('F d, Y'),
                'applicantName' => trim("{$user->first_name} {$user->middle_name} {$user->last_name} {$user->extension_name}"),
                'applicantAddress' => $user->applicantProfile
                    ? trim(implode(', ', array_filter([
                        $user->applicantProfile->barangay,
                        $user->applicantProfile->city ?? $user->applicantProfile->municipality,
                        $user->applicantProfile->province,
                        $user->applicantProfile->zip_code,
                    ])))
                    : '—',
                'status' => $app->status,
                'evaluationDate' => $this->evaluationDate,
                'applicationCode' => $app->application_code,
                'sectorData' => $this->sectorData,
            ],
        );
    }

    private function formatEducation(Application $app): string
    {
        return $app->educations
            ->map(fn($e) => trim("{$e->school_name}" . ($e->course ? " - {$e->course}" : '') . ($e->year_graduated ? " ({$e->year_graduated})" : '')))
            ->filter()
            ->implode("\n");
    }

    private function formatExperience(Application $app): string
    {
        return $app->experiences
            ->map(function ($e) {
                $dates = optional($e->start_date)->format('Y') . ' - ' . ($e->is_present ? 'Present' : optional($e->end_date)->format('Y'));
                return trim("{$e->position} at {$e->employer} ({$dates})");
            })
            ->filter()
            ->implode("\n");
    }

    private function formatTraining(Application $app): string
    {
        return $app->trainings
            ->map(fn($t) => trim("{$t->training_title}" . ($t->training_hours ? " ({$t->training_hours} hrs)" : '')))
            ->filter()
            ->implode("\n");
    }

    private function formatEligibility(Application $app): string
    {
        return $app->eligibilities
            ->map(fn($e) => trim(
                ($e->eligibilityType?->name ?? $e->other_name ?? 'Eligibility')
                . ($e->license_no ? " (License: {$e->license_no})" : '')
            ))
            ->filter()
            ->implode("\n");
    }
}
