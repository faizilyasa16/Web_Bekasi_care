<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; // karena nama tabel tidak jamak (bukan "laporans")

    protected $fillable = [
        'user_id',
        'lokasi',
        'keluhan',
        'urgensi',
        'kebutuhan',
        'foto',
        'latitude',
        'longitude',
        'status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function statusHistories()
    {
        return $this->hasMany(LaporanStatusHistory::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(LaporanStatusHistory::class)->latestOfMany();
    }

}
