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
        Schema::create('tasks', function (Blueprint $table) {
            $table->unsignedMediumInteger('id')->autoIncrement();
            $table->string('name', 255)->nullable();
            $table->timestamp('deadline');
            
            $table->unsignedMediumInteger('lecture_id');
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
