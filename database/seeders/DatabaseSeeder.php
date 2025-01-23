<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Thread;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        Category::factory(5)->create();

        Thread::factory(10)->create()->each(function (Thread $thread) { 
            $categories = Category::inRandomOrder()->take(rand(1, 3))->get(); 
            $thread->categories()->attach($categories); 
        });

        Post::factory(50)->create();
    }
}