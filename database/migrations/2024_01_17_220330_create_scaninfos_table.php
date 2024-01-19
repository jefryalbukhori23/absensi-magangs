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
        Schema::create('scaninfos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_students');
            $table->string('status'); // C (cocok) // S (sudah Absen) // G (gagal) // F (Foto) // P (Sudah Cek)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scaninfos');
    }
};
