<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_position_id')->constrained('plantilla_positions')->onDelete('cascade');
            $table->decimal('monthly_salary', 12, 2);
            $table->text('description')->nullable();
            $table->string('required_education', 255)->nullable();
            $table->string('required_training', 255)->nullable();
            $table->string('required_experience', 255)->nullable();
            $table->string('required_eligibility', 255)->nullable();
            $table->json('requirements')->nullable();
            $table->dateTime('deadline');
            $table->string('job_description_pdf', 500)->nullable();
            $table->enum('status', ['draft', 'open', 'closed'])->default('draft');
            $table->dateTime('posted_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('deadline');
            $table->index(['status', 'deadline']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};