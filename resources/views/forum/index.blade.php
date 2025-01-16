@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
       <h1 class="text-2xl font-bold mb-4">Forum Threads</h1>

       <!-- Button to Create New Thread -->
       @auth
          <div class="mb-4">
              <a href="{{ route('forum.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                 Create New Thread
             </a>
          </div>
      @endauth
        <div class="mb-4">
               <form method="GET" action="{{ route('forum.index') }}" class="flex flex-col md:flex-row items-center justify-center space-y-2 md:space-y-0 md:space-x-2">
                    <input
                       type="text"
                        name="search"
                       value="{{ request('search') }}"
                        placeholder="Search thread"
                       class="py-2 px-3 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   />
                 <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                         Search
                       </button>
                </form>
           </div>

        <!-- Display Threads -->
       <div class="space-y-4">
            @forelse($threads as $thread)
              <div class="p-4 border border-gray-200 rounded-md">
                    <!-- Clickable Thread Title -->
                   <h2 class="text-xl font-bold">
                      <a href="{{ route('forum.show', $thread->id) }}" class="text-blue-500 hover:underline">
                         {{ $thread->title }}
                      </a>
                  </h2>

                   <p class="text-sm text-gray-500">Posted {{ $thread->created_at->diffForHumans() }}</p>

                   <!-- Thread Content Preview -->
                   <p class="text-gray-700 mt-2">{{ Str::limit($thread->content, 150, '...') }}</p>

                    <!-- Categories -->
                   <div class="mt-2">
                       <strong>Categories:</strong>
                        <div class="flex flex-wrap gap-2 mt-1">
                             @foreach($thread->categories as $category)
                               <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm">
                                      {{ $category->name }}
                                 </span>
                              @endforeach
                         </div>
                    </div>

                     <!-- Admin Delete Button (Only for Admins) -->
                     @auth
                         @if(Auth::user()->isAdmin()) <!-- Użycie metody isAdmin() -->
                             <form action="{{ route('thread.destroy', $thread->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this thread?')">
                                 @csrf
                                 @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                        Delete Thread
                                     </button>
                             </form>
                        @endif
                   @endauth
              </div>
           @empty
                <p class="text-gray-500">No threads available. Be the first to create one!</p>
            @endforelse
      </div>
     <!-- Pagination Links -->
      <div class="mt-4">
           {{ $threads->links() }}
     </div>
    </div>
@endsection