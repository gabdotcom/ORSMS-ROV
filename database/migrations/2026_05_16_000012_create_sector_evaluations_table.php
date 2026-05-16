<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sector_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->enum('sector', ['education', 'training', 'experience', 'eligibility']);
            $table->enum('status', ['pending', 'qualified', 'disqualified'])->default('pending');
            $table->text('remarks')->nullable();
            $table->foreignId('evaluated_by')->constrained('users')->onDelete('cascade');
            $table->dateTime('evaluated_at')->nullable();
            $table->timestamps();

            $table->index(['application_id', 'sector']);
            $table->index('evaluated_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sector_evaluations');
    }
};