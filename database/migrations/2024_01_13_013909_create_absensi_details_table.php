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
        Schema::create('absensi_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_absensi');
            $table->bigInteger('id_student');
            $table->string('needs'); // D (datang), P (Pulang)
            $table->string('status'); // Tepat,Telat
            $table->time('time');
            $table->string('photo');
            $table->longText('latitude'); 
            $table->longText('longitude'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_details');
    }
};
