<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->string('level', 100);
            $table->string('school_name', 255);
            $table->string('course', 255)->nullable();
            $table->string('units_completed', 100)->nullable();
            $table->year('year_graduated')->nullable();
            $table->string('file_path', 500)->nullable();
            $table->timestamps();

            $table->index('application_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_educations');
    }
};