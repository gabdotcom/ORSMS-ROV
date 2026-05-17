<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['plantilla_position_id', 'monthly_salary', 'description', 'required_education', 'required_training', 'required_experience', 'required_eligibility', 'requirements', 'deadline', 'job_description_pdf', 'status', 'posted_at'])]
class JobPosting extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
            'posted_at' => 'datetime',
            'requirements' => 'array',
        ];
    }

    public function plantillaPosition(): BelongsTo
    {
        return $this->belongsTo(PlantillaPosition::class, 'plantilla_position_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}