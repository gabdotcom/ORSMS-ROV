<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantProfile extends Model
{
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'civil_status',
        'citizenship',
        'religion',
        'ethnicity',
        'contact_number',
        'is_person_with_disability',
        'is_solo_parent',
        'is_member_of_indigenous_people',
        'region',
        'province',
        'city',
        'municipality',
        'barangay',
        'zip_code',
        'current_address',
        'avatar_path',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_person_with_disability' => 'boolean',
        'is_solo_parent' => 'boolean',
        'is_member_of_indigenous_people' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}