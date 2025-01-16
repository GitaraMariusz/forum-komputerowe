<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index(Request $request)
     {
          $search = $request->input('search');

            $users = User::where('id', '!=', Auth::id())
                         ->when($search, function ($query, $search) {
                          $query->where('name', 'like', '%' . $search . '%')
                                  ->orWhere('email', 'like', '%' . $search . '%');
                          })->paginate(10);

          return view('community.index', compact('users','search'));
     }

    public function show(User $user)
    {
        $messages = PrivateMessage::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('community.show', compact('user', 'messages'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);

        return redirect()->route('community.show', $user)->with('success', 'Message sent!');
    }
}
