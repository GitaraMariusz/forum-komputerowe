<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    // Relationship with posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relationship with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'thread_category');
    }

    // Relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }   
    public function watchedByUsers()
    {
        return $this->belongsToMany(User::class, 'thread_watches', 'thread_id', 'user_id')
                    ->withTimestamps();
    }
}
