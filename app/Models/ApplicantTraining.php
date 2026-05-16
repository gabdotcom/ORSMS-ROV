<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantTraining extends Model
{
    protected $fillable = [
        'application_id',
        'training_title',
        'training_hours',
        'date_conducted',
        'file_path',
    ];

    protected $casts = [
        'training_hours' => 'integer',
        'date_conducted' => 'date',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}