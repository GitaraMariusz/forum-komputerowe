<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostReport;

class AdminController extends Controller
{
    // Metoda do wyświetlania dashboarda
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })->paginate(10);


        $posts = Post::all();

       return view('admin.dashboard', compact('users', 'posts','search'));
    }

    public function destroyUser(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Nie możesz usunąć administratora.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Użytkownik został usunięty.');
    }

    public function destroyPost(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Post został usunięty.');
    }
    public function reportedPosts()
    {
        $reportedPosts = PostReport::with('post')->get();

        return view('admin.reported-posts', compact('reportedPosts'));
    }

    public function deleteReportedPost($id)
    {
        $postReport = PostReport::where('post_id', $id)->firstOrFail();
        $post = $postReport->post;

        $post->delete();
        $postReport->delete();

        return redirect()->route('admin.reported-posts')->with('success', 'Post został usunięty.');
    }
    public function deleteReport($id)
    {
        $postReport = PostReport::where('post_id', $id)->firstOrFail();
        $postReport->delete();

        return redirect()->route('admin.reported-posts')->with('success', 'Zgłoszenie zostało usunięte.');
    }
}
