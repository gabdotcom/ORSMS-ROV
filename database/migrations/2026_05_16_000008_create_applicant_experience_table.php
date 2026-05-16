<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_experience', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->string('employer', 255);
            $table->string('position', 255);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_present')->default(false);
            $table->string('sector', 100)->nullable();
            $table->decimal('total_exp_years', 5, 2)->nullable();
            $table->string('file_path', 500)->nullable();
            $table->timestamps();

            $table->index('application_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_experience');
    }
};