@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Community</h1>

        <div class="space-y-4">
            @foreach($users as $user)
                <div class="p-4 bg-white shadow-sm rounded-md border">
                    <a href="{{ route('community.show', $user) }}" class="text-blue-500">{{ $user->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
