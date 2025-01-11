<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;

class HomeController extends Controller
{
    // Display the homepage with recent threads and categories
    public function index()
    {
        // Get the 5 most recent threads
        $threads = Thread::latest()->take(3)->get();
        
        // Get all categories
        $categories = Category::all();
        
        return view('home', compact('threads', 'categories'));
    }
}

