<?php

namespace Database\Seeders;

use App\Models\EligibilityType;
use Illuminate\Database\Seeder;

class EligibilityTypeSeeder extends Seeder
{
    public function run(): void
    {
        $eligibilities = [
            ['name' => 'LET - Licensure Examination for Teachers', 'is_active' => true],
            ['name' => 'CSE - Civil Service Examination (Professional)', 'is_active' => true],
            ['name' => 'CSE - Civil Service Examination (Subprofessional)', 'is_active' => true],
            ['name' => 'RA 1080 - Career Service Sabatical', 'is_active' => true],
            ['name' => 'Other', 'is_active' => true],
        ];

        foreach ($eligibilities as $eligibility) {
            EligibilityType::create($eligibility);
        }
    }
}