@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $thread->title }}</h1>
        <p class="text-sm text-gray-500">Posted {{ $thread->created_at->diffForHumans() }}</p>
        
        <div class="mt-4">
            <p>{{ $thread->content }}</p>
        </div>

        <div class="mt-6">
            <strong>Categories:</strong>
            <div class="mt-2">
                @foreach($thread->categories as $category)
                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
@endsection
