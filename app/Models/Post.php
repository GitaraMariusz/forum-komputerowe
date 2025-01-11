<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'thread_id'];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with thread
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    // Relationship with post likes
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    // Relationship with post reports
    public function reports()
    {
        return $this->hasMany(PostReport::class);
    }
}
