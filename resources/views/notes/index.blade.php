@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            @if(request('category_id'))
                <p class="text-2xl font-bold text-gray-800">Searching in <strong>{{ $categories->find(request('category_id'))->name }}</strong></p>
            @else
                <p class="text-2xl font-bold text-gray-800">{{ ucwords('Manage your knowledge base.') }}</p>
            @endif
        </div>
        
        <form action="{{ route('notes.index') }}" method="GET" class="w-full md:w-1/3 flex gap-2">
            
            @if(request('category_id'))
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            @endif

            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full border-2 border-gray-300 rounded-lg focus:outline-none px-2 py-2 text-xs transition-colors" 
                placeholder="Search inside this list...">
                
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @foreach($notes as $idx=>$note)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-200 overflow-hidden group relative">
                
                <!-- the : button -->
                <div class="absolute top-3 right-3 z-10">
                    <button onclick="toggleDropdown(event, 'menu-{{ $note->id }}')" class="dropdown-btn p-1.5 rounded-full bg-white/90 hover:bg-white text-gray-600 shadow-sm backdrop-blur-sm transition-colors">
                        <svg class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>

                    <div id="menu-{{ $note->id }}" class="dropdown-menu hidden absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-20">
                        
                        <a href="{{ route('notes.edit', $note) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Edit</a>
                        
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this {{ $note->title }} note?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Delete</button>
                        </form>
                    </div>
                </div>

                <!-- the Card box -->
                <a href="{{ route('notes.show',$note) }}" class="block h-full flex flex-col">
                    @if($note->images()->count() > 0)
                    <div class="h-48 w-full bg-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset($note->images->first()->image) }}" alt="Cover" class="w-full h-full object-fill">
                    </div>
                    @else
                        <div class="h-48 w-full bg-gray-100 flex items-center justify-center overflow-hidden">
                            <span>No Image to Show</span>
                        </div>
                    @endif

                    <div class="p-5 flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-indigo-50 text-indigo-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $note->category->name }}</span>
                            <span class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-snug group-hover:text-indigo-600 transition">{{ ucwords($note->title) }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3">{!! $note->description !!}</p>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    
    <div class="mt-6">
        {{ $notes->links() }}
    </div>
@endsection

@section('scripts')
    <script>
        function toggleDropdown(event, menuId) {
            // 1. Stop the click from bubbling up to the window (prevents immediate closing)
            event.stopPropagation();

            // 2. Find the menu we want to toggle
            const menu = document.getElementById(menuId);
            const isHidden = menu.classList.contains('hidden');

            // 3. Close ALL other open dropdowns first (so only one is open at a time)
            document.querySelectorAll('.dropdown-menu').forEach(el => {
                el.classList.add('hidden');
            });

            // 4. If the clicked menu was hidden, show it now
            if (isHidden) {
                menu.classList.remove('hidden');
            }
        }

        // 5. Global "Click Outside" Listener
        window.onclick = function(event) {
            // If the user clicks anywhere that isn't a dropdown button
            if (!event.target.closest('.dropdown-btn')) {
                // Close all menus
                document.querySelectorAll('.dropdown-menu').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        }
    </script>
@stop