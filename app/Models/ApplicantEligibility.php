<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantEligibility extends Model
{
    protected $table = 'applicant_eligibilities';
    
    protected $fillable = [
        'application_id',
        'eligibility_type_id',
        'other_name',
        'license_no',
        'date_issued',
        'file_path',
    ];

    protected $casts = [
        'date_issued' => 'date',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function eligibilityType(): BelongsTo
    {
        return $this->belongsTo(EligibilityType::class);
    }
}