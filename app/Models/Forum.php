<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forum';

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'views',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }
}
