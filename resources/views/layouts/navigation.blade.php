<nav x-data="{ open: false }"
     class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-[#0A0F29]/95 to-[#14173A]/95 backdrop-blur-xl border-b border-white/10 shadow-xl">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- LEFT SECTION --}}
            <div class="flex items-center space-x-10">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    {{-- <x-application-logo class="h-8 w-auto text-indigo-400" /> --}}
                    <span class="text-xl font-bold text-white">PetConcert</span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex space-x-8">

                    <a href="{{ route('home') }}"
                       class="text-gray-200 hover:text-indigo-400 transition
                              {{ request()->routeIs('home') ? 'text-indigo-400 font-semibold' : '' }}">
                        Home
                    </a>

                    <a href="{{ route('events.index') }}"
                       class="text-gray-200 hover:text-indigo-400 transition
                              {{ request()->routeIs('events.index') ? 'text-indigo-400 font-semibold' : '' }}">
                        Events List
                    </a>

                    @auth
                    <a href="{{ route('tickets.index') }}"
                       class="text-gray-200 hover:text-indigo-400 transition
                              {{ request()->routeIs('tickets.index') ? 'text-indigo-400 font-semibold' : '' }}">
                        My Tickets
                    </a>
                    @endauth

                </div>
            </div>

            {{-- RIGHT SECTION --}}
            <div class="hidden md:flex items-center space-x-6">

                @auth
                <div class="relative" x-data="{ openUser: false }">

                    <button @click="openUser = !openUser"
                            class="flex items-center space-x-2 bg-[#0F1F45]/60 hover:bg-[#1C2A5A] 
                                   border border-white/10 px-4 py-2 rounded-full text-gray-200 shadow-md transition">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.13l3.71-3.9a.75.75 0 011.08 1.04l-4.21 4.42a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z"/>
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="openUser" @click.away="openUser=false"
                         class="absolute right-0 mt-2 w-48 bg-[#0B132E] text-gray-200 shadow-xl rounded-xl border border-white/10 py-2">

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-[#1A235A]/50 rounded-lg">
                                Log Out
                            </button>
                        </form>

                    </div>
                </div>

                @else

                {{-- LOGIN --}}
                <a href="{{ route('login') }}"
                   class="font-medium px-4 py-2 rounded-full border border-indigo-500 text-indigo-300
                          hover:bg-indigo-600 hover:text-white transition shadow-md">
                    Login
                </a>

                {{-- REGISTER --}}
                <a href="{{ route('register') }}"
                   class="font-medium px-4 py-2 rounded-full bg-indigo-600 text-white 
                          hover:bg-indigo-700 transition shadow-md">
                    Register
                </a>

                @endauth
            </div>

            {{-- Mobile Toggle --}}
            <button @click="open = !open"
                    class="md:hidden p-2 rounded-lg hover:bg-[#1A235A]/50 text-gray-200 transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor">
                    <path x-show="!open" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" class="md:hidden bg-[#0B132E]/95 border-b border-white/10 text-gray-200">

        <div class="px-4 pt-3 pb-4 space-y-3">

            <a href="{{ route('home') }}" class="block hover:text-indigo-400 transition">
                Home
            </a>

            <a href="{{ route('events.index') }}" class="block hover:text-indigo-400 transition">
                Events List
            </a>

            @auth
                <a href="{{ route('tickets.index') }}" class="block hover:text-indigo-400 transition">
                    My Tickets
                </a>
            @endauth

        </div>

        <div class="border-t border-white/10 px-4 py-4">

            @auth
                <div class="mb-3">
                    <div class="font-medium text-gray-100">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-2 hover:bg-[#1A235A]/50 rounded-lg transition">
                        Log Out
                    </button>
                </form>

            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 hover:text-indigo-400 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 hover:text-indigo-400 transition">
                    Register
                </a>
            @endauth

        </div>
    </div>
</nav>
