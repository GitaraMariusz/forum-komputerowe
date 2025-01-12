<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    // Funkcja do rozpoczęcia obserwowania wątku
    public function watch($id)
    {
        $thread = Thread::findOrFail($id);

        // Sprawdzamy, czy użytkownik jest już zalogowany
        if (auth()->check()) {
            // Dodajemy użytkownika do obserwujących ten wątek
            auth()->user()->threadWatches()->attach($thread->id);
        }

        return redirect()->route('forum.show', $thread->id);
    }

    // Funkcja do zakończenia obserwowania wątku
    public function unwatch($id)
    {
        $thread = Thread::findOrFail($id);

        // Sprawdzamy, czy użytkownik jest już zalogowany
        if (auth()->check()) {
            // Usuwamy użytkownika z obserwujących ten wątek
            auth()->user()->threadWatches()->detach($thread->id);
        }

        return redirect()->route('forum.show', $thread->id);
    }
}
