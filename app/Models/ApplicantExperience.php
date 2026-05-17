<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantExperience extends Model
{
    protected $table = 'applicant_experiences';
    
    protected $fillable = [
        'application_id',
        'employer',
        'position',
        'start_date',
        'end_date',
        'is_present',
        'sector',
        'total_exp_years',
        'file_path',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_present' => 'boolean',
        'total_exp_years' => 'decimal:2',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}