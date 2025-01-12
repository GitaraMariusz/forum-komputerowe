<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'thread_id' => 'required|exists:threads,id',
        ]);

        // Create a new post
        Post::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'thread_id' => $request->thread_id,
        ]);

        return redirect()->route('forum.show', $request->thread_id)->with('success', 'Post added successfully!');
    }
}
