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
        Schema::create('semester_subject', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('semester_id');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            $table->unsignedSmallInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_subject');
    }
};
