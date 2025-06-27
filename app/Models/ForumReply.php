<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id',
        'user_id',
        'isi',
    ];

    // Relasi ke forum
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    // Relasi ke user (yang membalas)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
