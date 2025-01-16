@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="text-center mb-12">
            <h1 class="text-2xl font-bold mb-4"><span>Welcome to the Computer Forum!</span></h1>
            <p class="mb-8 text-gray-600">
                Feel free to browse discussions, share your experiences, ask questions, or help others find their way. Together, let's expand our knowledge and appreciation for the ever-evolving world of computer technology. Welcome to the community—we're happy to have you join us!
                </p>
        </div>
       <div class="flex flex-col items-center">
             <img src="/img/image.jpg" alt="Placeholder Image" class="w-3/4 rounded-md mb-4">
        </div>
       <div class="mt-12">
             <h2 class="text-2xl font-bold mb-6"><span>Recent Discussions</span></h2>
            <p class="mb-4 text-gray-600 text-center">
                Take a look at the recent discussions, and join in!
             </p>
           <div class="space-y-6">
                @foreach($threads as $thread)
                     <div class="p-6 border border-gray-200 rounded-md flex flex-col bg-white">
                          <h3 class="font-semibold mb-2">
                          <a href="{{ route('forum.show', $thread->id) }}" class="text-blue-500 hover:underline font-inherit">
                                 {{ $thread->title }}
                              </a>
                         </h3>
                          <div class="flex space-x-2 justify-between items-center">
                               <p class="text-sm text-gray-500">{{ $thread->created_at->diffForHumans() }}</p>
                              <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-md">{{ $thread->user->name }}</span>
                          </div>

                         <p class="text-gray-700 mt-2">{{ Str::limit($thread->content, 250) }}</p>
                      </div>
                    @endforeach
                </div>
       </div>
    </div>
@endsection