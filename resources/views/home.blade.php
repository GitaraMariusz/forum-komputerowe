@extends('layouts.app')

@section('content')
    <div class="container mx-auto text-center py-8">
        <h1 class="text-4xl font-bold mb-4">Welcome to the Computer Forum!</h1>
        <p class="text-lg mb-6">
            This is a community-driven platform where technology enthusiasts gather to discuss the latest in computing, share tips, and troubleshoot problems. Whether you're a beginner or a seasoned professional, there's something for everyone.
        </p>
        <p>
            Join the conversation, ask questions, or help others with your expertise!
        </p>

        <!-- Display the latest threads -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Recent Threads</h2>
            <div class="space-y-4">
            @foreach($threads as $thread)
                <div class="p-4 border border-gray-200 rounded-md">
                    <h3 class="text-xl font-semibold">
                        <a href="{{ route('forum.show', $thread->id) }}" class="text-blue-500 hover:underline">
                            {{ $thread->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500">{{ $thread->created_at->diffForHumans() }}</p>
                    <p class="text-gray-700 mt-2">{{ Str::limit($thread->content, 150) }}</p>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
