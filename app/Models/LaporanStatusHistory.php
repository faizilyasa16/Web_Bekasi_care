<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanStatusHistory extends Model
{
    use HasFactory;

    // Nama tabel eksplisit jika kamu pakai "laporan_status_histories" atau nama lain
    protected $table = 'laporan_status_histories';

    protected $fillable = [
        'laporan_id',
        'user_id',
        'status',
        'deskripsi',
        'bukti',
    ];

    /**
     * Relasi ke model Laporan
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    /**
     * Relasi ke model User (admin yang menangani)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
