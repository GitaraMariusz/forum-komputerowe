@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Community</h1>
         <div class="mb-4">
             <form method="GET" action="{{ route('community.index') }}" class="flex flex-col md:flex-row items-center justify-center space-y-2 md:space-y-0 md:space-x-2">
               <input
                     type="text"
                     name="search"
                     value="{{ request('search') }}"
                       placeholder="Szukaj użytkownika"
                        class="py-2 px-3 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                      />
                       <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                          Szukaj
                         </button>
             </form>
         </div>

        <div class="space-y-4">
             @foreach($users as $user)
                <div class="p-4 bg-white shadow-sm rounded-md border">
                      <a href="{{ route('community.show', $user) }}" class="text-blue-500">{{ $user->name }}</a>
                 </div>
               @endforeach
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
   </div>
@endsection