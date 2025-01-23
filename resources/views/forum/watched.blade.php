@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Watched Threads</h1>

        @forelse ($watchedThreads as $thread)
            <div class="mb-4 p-4 border border-gray-200 rounded-md">
                <h2 class="text-xl font-bold"><a href="{{ route('forum.show', $thread->id) }}" class="hover:underline">{{ $thread->title }}</a></h2>
                <p class="text-gray-700">{{ Str::limit($thread->content, 200) }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    Created by: {{ $thread->user->name }} | Categories:
                    @foreach ($thread->categories as $category)
                        <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-2">{{ $category->name }}</span>
                    @endforeach
                </p>
            </div>
        @empty
            <p class="text-gray-500">You are not watching any threads yet.</p>
        @endforelse

        {{ $watchedThreads->links() }} {{-- Paginacja --}}
    </div>
@endsection