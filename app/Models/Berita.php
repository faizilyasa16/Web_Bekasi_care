<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    // Mengizinkan mass assignment
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'gambar',
        'status',
    ];

    /**
     * Relasi ke model User (penulis berita).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
