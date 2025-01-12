<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostReportController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        PostReport::create([
            'reason' => $request->reason,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'Post has been reported.');
    }
}

