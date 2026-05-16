<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosting extends Model
{
    protected $fillable = [
        'plantilla_position_id',
        'monthly_salary',
        'description',
        'required_education',
        'required_training',
        'required_experience',
        'required_eligibility',
        'requirements',
        'deadline',
        'job_description_pdf',
        'status',
        'posted_at',
    ];

    protected $casts = [
        'monthly_salary' => 'decimal:2',
        'deadline' => 'datetime',
        'requirements' => 'array',
        'posted_at' => 'datetime',
    ];

    public function plantillaPosition(): BelongsTo
    {
        return $this->belongsTo(PlantillaPosition::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}