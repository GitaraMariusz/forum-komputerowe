@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $thread->title }}</h1>
        <p class="text-gray-700 mb-6">{{ $thread->content }}</p>
        <p class="text-sm text-gray-500">Posted {{ $thread->created_at->diffForHumans() }}</p>

        <!-- Display Existing Posts -->
        <div class="mt-6">
            <h2 class="text-xl font-bold mb-4">Posts</h2>
            @forelse($thread->posts as $post)
                <div class="p-4 border border-gray-200 rounded-md mb-4">
                    <p class="text-gray-700">{{ $post->content }}</p>
                    <p class="text-sm text-gray-500">Posted by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</p>

                    <!-- Like Button -->
                    @auth
                        <form action="{{ route('post.like', $post->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                @if ($post->likes->where('user_id', auth()->id())->count() > 0)
                                    Unlike
                                @else
                                    Like
                                @endif
                            </button>
                        </form>
                    @endauth

                    <!-- Display Like Count -->
                    <p class="text-sm text-gray-500 mt-1">{{ $post->likes->count() }} likes</p>
                </div>
            @empty
                <p class="text-gray-500">No posts yet. Be the first to reply!</p>
            @endforelse
        </div>

        <!-- Post Creation Form (Only for Authenticated Users) -->
        @auth
            <div class="mt-6">
                <h2 class="text-xl font-bold mb-4">Add a Post</h2>
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Your Post</label>
                        <textarea name="content" id="content" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Submit
                    </button>
                </form>
            </div>
        @endauth

        @guest
            <p class="text-gray-500 mt-6">You must <a href="{{ route('login') }}" class="text-blue-500 underline">log in</a> to reply to this thread.</p>
        @endguest
    </div>
@endsection
