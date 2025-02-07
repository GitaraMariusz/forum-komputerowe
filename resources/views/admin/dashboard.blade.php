@extends('layouts.app')

@section('content')
   <div class="container mx-auto text-center py-8">
        <h1 class="text-4xl font-bold mb-6">Administrator Panel</h1>
   
      <!-- Wyświetlanie komunikatów -->
      @if(session('success'))
          <div class="alert alert-success mb-4 px-4 py-2 text-green-700 bg-green-100 border border-green-300 rounded-lg">
              {{ session('success') }}
          </div>
      @elseif(session('error'))
          <div class="alert alert-danger mb-4 px-4 py-2 text-red-700 bg-red-100 border border-red-300 rounded-lg">
               {{ session('error') }}
           </div>
      @endif

          <!-- Przycisk do zgłoszonych postów -->
          <div class="mt-8 mb-6">
             <a href="{{ route('admin.reported-posts') }}" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">
                  Reported posts
             </a>
       </div>
       <div class="mb-4">
          <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col md:flex-row items-center justify-center space-y-2 md:space-y-0 md:space-x-2">
                  <input
                      type="text"
                      name="search"
                     value="{{ request('search') }}"
                      placeholder="Search user"
                      class="py-2 px-3 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                     <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                     Search
                     </button>
                 </form>
       </div>

      <!-- Lista użytkowników -->
      <div class="mb-8">
          <h2 class="text-2xl font-semibold mb-4">Users</h2>
          <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                 <thead class="bg-gray-100">
                      <tr>
                         <th class="px-4 py-2 text-left">Name</th>
                          <th class="px-4 py-2 text-left">Email</th>
                         <th class="px-4 py-2 text-center">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                      @foreach ($users as $user)
                       <tr class="border-t">
                           <td class="px-4 py-2">{{ $user->name }}</td>
                           <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center">
                               <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                                    @csrf
                                      @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none">
                                          Usuń
                                      </button>
                              </form>
                         </td>
                        </tr>
                    @endforeach
                 </tbody>
             </table>
            <div class="mt-4">
                {{ $users->links() }}
           </div>
        </div>
  </div>
@endsection