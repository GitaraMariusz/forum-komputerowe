@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Forum Threads</h1>

        <!-- Button to Create New Thread -->
        <div class="mb-4">
            <a href="{{ route('forum.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                Create New Thread
            </a>
        </div>

        <div class="space-y-4">
            @foreach($threads as $thread)
                <div class="p-4 border border-gray-200 rounded-md">
                    <h2 class="text-xl font-bold">{{ $thread->title }}</h2>
                    <p class="text-sm text-gray-500">{{ $thread->created_at->diffForHumans() }}</p>
                    <p>{{ $thread->content }}</p>

                    <div class="mt-2">
                        <strong>Categories:</strong>
                        @foreach($thread->categories as $category)
                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $threads->links() }}
        </div>
    </div>
@endsection
