@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Messages with {{ $user->name }}</h1>

        <div class="space-y-4">
            @foreach($messages as $message)
                <div class="p-4 bg-white shadow-sm rounded-md border">
                    <div class="font-semibold">{{ $message->sender->name }}</div>
                    <p class="text-sm text-gray-500">{{ $message->content }}</p>
                    <p class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('community.sendMessage', $user) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="content" rows="4" class="w-full p-2 border rounded-md" placeholder="Write a message..."></textarea>
            <button type="submit" class="mt-2 bg-blue-500 text-white p-2 rounded-md">Send Message</button>
        </form>
    </div>
@endsection