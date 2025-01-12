<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;

class PostLikeController extends Controller
{
    public function like($postId)
    {
        // Find the post
        $post = Post::findOrFail($postId);

        // Check if the user has already liked the post
        $like = PostLike::where('user_id', auth()->id())
                        ->where('post_id', $postId)
                        ->first();

        if ($like) {
            // If the user already liked the post, remove the like (unlike)
            $like->delete();
        } else {
            // If the user hasn't liked the post, create a like
            PostLike::create([
                'user_id' => auth()->id(),
                'post_id' => $postId,
            ]);
        }

        // Redirect back to the thread page
        return redirect()->route('forum.show', $post->thread_id);
    }
}
