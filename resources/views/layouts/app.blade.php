<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="{{ asset('assets/libs/summernote-0.9.0-dist/summernote-lite.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/toastr-master/toastr-master/build/toastr.min.css') }}">

    @yield('css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 md:hidden">
        </div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 flex flex-col transition-transform duration-300 transform md:translate-x-0 md:static md:inset-auto">
            
            <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200">
                <span class="text-xl font-bold text-indigo-600">NoteApp</span>
                
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
    
                <a href="{{ route('notes.index') }}" class="flex items-center px-4 py-2 rounded-lg transition-colors {{ (request()->routeIs('notes.index') && !request('category_id')) ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ (request()->routeIs('notes.index') && !request('category_id')) ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    All Notes
                </a>

                <div x-data="{ open: {{ request('category_id') || request()->routeIs('categories.*') ? 'true' : 'false' }} }" class="space-y-1">
                    
                    <button @click="open = !open" 
                            class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors focus:outline-none">
                        <div class="flex items-center">
                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            Categories
                        </div>
                        <svg :class="{'rotate-90': open}" class="h-4 w-4 text-gray-400 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse class="space-y-1 pl-11">
                        
                        <a href="{{ route('categories.index') }}" 
                        class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'text-indigo-700 bg-indigo-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            Manage Categories
                        </a>

                        @if(isset($categories))
                            @foreach($categories as $cat)
                                <a href="{{ route('notes.index', ['category_id' => $cat->id]) }}" 
                                class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request('category_id') == $cat->id ? 'text-indigo-700 bg-indigo-50 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <a href="{{ route('dashboards.index') }}" class="flex items-center px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboards.index') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('dashboards.index') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboards
                </a>

            </nav>
            
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                        {{ substr(ucwords(Auth::user()->name) ?? 'U', 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ ucwords(Auth::user()->name) ?? 'User' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-8">
                
                <button @click="sidebarOpen = true" class="md:hidden mr-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex-1 max-w-2xl">
                    <form action="{{ route('notes.index') }}" method="GET">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Search entire notes...">
                        </div>
                    </form>
                </div>

                <div class="ml-4 flex items-center space-x-2 md:space-x-4">
                    
                    <a href="{{ route('notes.create') }}" class="inline-flex items-center px-3 py-2 md:px-4 md:py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 hidden md:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="md:hidden">+</span>
                        <span class="hidden md:block">New Note</span>
                    </a>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center max-w-xs bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-9 w-9 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-300 transition">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" 
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" 
                             style="display: none;"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95">
                            
                            <div class="px-4 py-2 border-b border-gray-100 flex items-center space-x-2">
                                <i class="fas fa-user"></i>
                                <p class="text-sm text-gray-500">Hi, </p>
                                <p class="text-sm text-gray-500 truncate">{{ ucwords(Auth::user()->name) ?? 'User' }}</p>
                            </div>

                            <div class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fa-solid fa-pen-to-square me-1"></i>Edit Profile

                                <!-- drop down -->
                                <a href="{{ route('profile.editinformation') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                    <i class="fa-regular fa-user mr-2"></i> Profile Info
                                </a>

                                <a href="{{ route('profile.editpassword') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                    <i class="fa-solid fa-key mr-2"></i> Password
                                </a>

                                <a href="{{ route('profile.deleteaccount') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                    <i class="fa-solid fa-trash mr-2"></i> Delete Account
                                </a>
                            </div>


                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa-solid fa-arrow-right-from-bracket me-1"></i>Sign out</button>
                            </form>
                        </div>
                    </div>
                    </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('assets/libs/summernote-0.9.0-dist/summernote-lite.min.js') }}"></script>

    <script src="{{ asset('assets/libs/toastr-master/toastr-master/build/toastr.min.js') }}"></script>
    
    <!-- Controller notifi -->
    @if(Session::has('success'))
        <script>toastr.success("{{ session()->get('success') }}","Success!",{timeOut:3000})</script>
    @endif

    @if(session('info'))
        <script>toastr.info("{{ session('info') }}","Information!",{timeOut:3000})</script>
    @endif

    @if(Session::has('error'))
        <script>toastr.error("{{ session()->get('error') }}","Failed!",{timeOut:3000})</script>
    @endif

    <!-- form error -->
    @if($errors)
        @foreach($errors->all() as $error)
            <script>toastr.error("{{ $error }}","Warning!",{timeOut:3000})</script>
        @endforeach
    @endif



    @yield('scripts')
</body>
</html>