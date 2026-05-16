<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_eligibility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->foreignId('eligibility_type_id')->constrained('eligibility_types')->onDelete('cascade');
            $table->string('other_name', 255)->nullable();
            $table->string('license_no', 100)->nullable();
            $table->date('date_issued')->nullable();
            $table->string('file_path', 500)->nullable();
            $table->timestamps();

            $table->index('application_id');
            $table->index('eligibility_type_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_eligibility');
    }
};