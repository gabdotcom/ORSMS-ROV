<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated', 'Annulled']);
            $table->string('citizenship', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('ethnicity', 100)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->boolean('is_person_with_disability')->default(false);
            $table->boolean('is_solo_parent')->default(false);
            $table->boolean('is_member_of_indigenous_people')->default(false);
            $table->string('region', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('municipality', 100)->nullable();
            $table->string('barangay', 100)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->text('current_address')->nullable();
            $table->string('avatar_path', 500)->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_profiles');
    }
};