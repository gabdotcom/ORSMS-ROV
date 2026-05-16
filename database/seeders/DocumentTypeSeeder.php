<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $documentTypes = [
            ['name' => 'Letter of Intent', 'is_required' => true, 'is_active' => true],
            ['name' => 'Personal Data Sheet (PDS) - CS Form No. 212, Revised 2017', 'is_required' => true, 'is_active' => true],
            ['name' => 'Work Experience Sheet', 'is_required' => true, 'is_active' => true],
            ['name' => 'Checklist of Requirements', 'is_required' => true, 'is_active' => true],
            ['name' => 'Omnibus Sworn Statement (CAV)', 'is_required' => true, 'is_active' => true],
            ['name' => 'Data Privacy Consent Form', 'is_required' => true, 'is_active' => true],
            ['name' => 'Other Requirements', 'is_required' => false, 'is_active' => true],
        ];

        foreach ($documentTypes as $documentType) {
            DocumentType::create($documentType);
        }
    }
}