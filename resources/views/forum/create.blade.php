<!-- resources/views/forum/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
  
        <h1 class="text-2xl font-bold mb-4">Create New Thread</h1>
        
        <form action="{{ route('forum.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="5" class="mt-1 block w-full" required></textarea>
            </div>

            <div class="mb-4">
                <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                <select name="category_ids[]" id="categories" class="mt-1 block w-full" multiple required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Thread</button>
        </form>
    </div>
@endsection
