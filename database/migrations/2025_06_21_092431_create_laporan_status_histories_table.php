<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('laporan_status_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ← Ini WAJIB ADA
        $table->enum('status', [
            'terima_laporan',
            'verifikasi_laporan',
            'penanganan_tindakan',
            'hasil_tindakan'
        ])->default('terima_laporan');
        $table->text('deskripsi')->nullable();
        $table->string('bukti')->nullable(); // path file bukti atau foto
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_status_histories');
    }
};
