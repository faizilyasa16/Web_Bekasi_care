<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('urgensi', ['sangat-tinggi', 'tinggi', 'normal', 'rendah', 'sangat-rendah'])->default('normal');
            // Informasi laporan
            $table->string('lokasi');
            $table->text('keluhan');
            $table->text('kebutuhan')->nullable();
            $table->string('foto')->nullable(); // bisa untuk path gambar bukti kejadian

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
