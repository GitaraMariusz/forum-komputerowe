<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
      {
        $search = $request->input('search');

         $threads = Thread::when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                     ->orWhere('content', 'like', '%' . $search . '%');
              })->with('categories')->paginate(4);


        return view('forum.index', compact('threads'));
      }


    public function create()
    {
        // Fetch all categories
        $categories = Category::all();
        return view('forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id'
        ]);

        $thread = Thread::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        // Attach categories to the thread
        $thread->categories()->sync($request->category_ids);

        return redirect()->route('forum.index');
    }
    public function show($id)
    {
        // Get the thread by ID
        $thread = Thread::findOrFail($id);

        return view('forum.show', compact('thread'));
    }

    // Dodane metody dla obserwowania wątków
    public function watchThread(Request $request, Thread $thread)
    {
        auth()->user()->threadsWatched()->attach($thread);
        return back()->with('success', 'Wątek obserwowany!');
    }

    public function unwatchThread(Request $request, Thread $thread)
    {
        auth()->user()->threadsWatched()->detach($thread);
        return back()->with('success', 'Przestałeś obserwować wątek.');
    }
    public function watchedThreads()
{
    $watchedThreads = auth()->user()->threadsWatched()->with('categories', 'user')->latest()->paginate(10); 
    return view('forum.watched', compact('watchedThreads'));
}
}