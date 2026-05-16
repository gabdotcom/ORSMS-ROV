<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantEducation extends Model
{
    protected $fillable = [
        'application_id',
        'level',
        'school_name',
        'course',
        'units_completed',
        'year_graduated',
        'file_path',
    ];

    protected $casts = [
        'year_graduated' => 'integer',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}