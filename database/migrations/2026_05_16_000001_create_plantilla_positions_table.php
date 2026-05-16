<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plantilla_positions', function (Blueprint $table) {
            $table->id();
            $table->string('department', 150);
            $table->string('position_name', 200);
            $table->string('position_code', 50);
            $table->string('plantilla_item_no', 100)->unique();
            $table->integer('salary_grade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('department');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plantilla_positions');
    }
};