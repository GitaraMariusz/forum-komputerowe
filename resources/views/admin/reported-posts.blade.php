@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-4">Zgłoszone Posty</h1>

        <!-- Wyświetlanie zgłoszonych postów -->
        <div class="space-y-4">
            @foreach ($reportedPosts as $report)
                <div class="p-4 border border-gray-200 rounded-md">
                    <h3 class="text-xl font-semibold">
                        <a href="{{ route('forum.show', $report->post->id) }}" class="text-blue-500 hover:underline">
                            {{ $report->post->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500">{{ $report->created_at->diffForHumans() }}</p>
                    <p class="text-gray-700 mt-2">{{ Str::limit($report->post->content, 150) }}</p>
                    <p class="text-red-500 mt-2"><strong>Powód zgłoszenia:</strong> {{ $report->reason }}</p>

                    <!-- Przycisk do usuwania postu -->
                    <form action="{{ route('admin.delete-reported-post', $report->post->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Usuń Post
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
