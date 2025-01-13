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
            $table->string('image')->nullable();
            $table->string('status')->default('pending');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            Medical Report
Medical Examinations
Passport Photo
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->unsignedSmallInteger('head_of_department_id');
            $table->foreign('head_of_department_id')->references('id')->on('head_of_departments')->onDelete('cascade');


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
