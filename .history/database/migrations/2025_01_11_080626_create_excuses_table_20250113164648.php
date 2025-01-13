<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excuses', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->string('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('material', ['Medical Report', 'Medical Examinations', 'Passport Photo', 'Other'])->default('Other');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->unsignedSmallInteger('department_id');
            $table->foreign('_department_id')->references('id')->on('head_of_departments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excuses');
    }
};
