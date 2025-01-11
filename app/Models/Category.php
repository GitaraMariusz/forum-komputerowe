<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship with threads
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'thread_category');
    }
}
