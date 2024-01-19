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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_school');
            $table->bigInteger('id_user');
            $table->string('fullname');
            $table->string('nisn')->nullable();
            $table->string('gender')->nullable(); // L or P
            $table->string('place_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('telephone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
