<nav x-data="{ open: false }" class="bg-brand-yellow border-b-4 border-black sticky top-0 z-50 font-body text-brand-black">
    <style>
        .shadow-retro-nav { box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }
        .shadow-retro-nav:active { box-shadow: none; transform: translate(2px, 2px); }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex gap-8">
                <div class="shrink-0 flex items-center">
                    @php
                        $homeRoute = Auth::user()->role == 'admin' ? route('admin.dashboard') : route('pos.index');
                    @endphp
                    <a href="{{ $homeRoute }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-black text-white flex items-center justify-center border-2 border-white shadow-[2px_2px_0px_0px_rgba(0,0,0,0.2)] group-hover:-rotate-6 transition-transform duration-200">
                            <span class="font-display font-bold text-xl">U</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-display font-bold text-xl uppercase leading-none tracking-tight">The Upperside</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest opacity-60">System Ver 1.0</span>
                        </div>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:gap-3">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.dashboard') ? 'bg-brand-purple text-white shadow-retro-nav' : 'bg-white hover:bg-gray-50 hover:shadow-retro-nav' }} 
                                  px-4 py-2 border-2 border-black font-bold uppercase text-xs tracking-widest transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.products.index') }}" 
                           class="{{ request()->routeIs('admin.products.*') ? 'bg-brand-purple text-white shadow-retro-nav' : 'bg-white hover:bg-gray-50 hover:shadow-retro-nav' }} 
                                  px-4 py-2 border-2 border-black font-bold uppercase text-xs tracking-widest transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Menu
                        </a>

                        <a href="{{ route('admin.tables.index') }}" 
                           class="{{ request()->routeIs('admin.tables.*') ? 'bg-brand-purple text-white shadow-retro-nav' : 'bg-white hover:bg-gray-50 hover:shadow-retro-nav' }} 
                                  px-4 py-2 border-2 border-black font-bold uppercase text-xs tracking-widest transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            Meja
                        </a>

                        <a href="{{ route('admin.users.index') }}" 
                           class="{{ request()->routeIs('admin.users.*') ? 'bg-brand-purple text-white shadow-retro-nav' : 'bg-white hover:bg-gray-50 hover:shadow-retro-nav' }} 
                                  px-4 py-2 border-2 border-black font-bold uppercase text-xs tracking-widest transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            User
                        </a>

                        <a href="{{ route('admin.reports.index') }}" 
                           class="{{ request()->routeIs('admin.reports.*') ? 'bg-brand-purple text-white shadow-retro-nav' : 'bg-white hover:bg-gray-50 hover:shadow-retro-nav' }} 
                                  px-4 py-2 border-2 border-black font-bold uppercase text-xs tracking-widest transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Laporan
                        </a>
                    
                    @elseif (Auth::user()->role == 'karyawan')
                        <a href="{{ route('pos.index') }}" 
                           class="{{ request()->routeIs('pos.*') ? 'bg-brand-purple text-white shadow-retro-nav' : 'bg-white hover:bg-gray-50 hover:shadow-retro-nav' }} 
                                  px-4 py-2 border-2 border-black font-bold uppercase text-xs tracking-widest transition-all duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Kasir (POS)
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-bold rounded-none bg-white hover:bg-brand-purple hover:text-white focus:outline-none transition-all duration-150 shadow-retro-nav active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-black text-white flex items-center justify-center font-bold text-xs border border-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="uppercase tracking-wide">{{ Auth::user()->name }}</div>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] -mt-2 ml-2 bg-white">
                            <div class="px-4 py-3 border-b-2 border-black bg-brand-yellow">
                                <p class="text-sm font-bold text-black uppercase">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-700 font-mono">{{ Auth::user()->email }}</p>
                                <span class="inline-block mt-1 bg-black text-white text-[10px] px-1 font-bold uppercase">{{ Auth::user()->role }}</span>
                            </div>

                            @if (Auth::user()->role == 'admin')
                                <x-dropdown-link :href="route('admin.profile.edit')" class="flex items-center space-x-2 hover:bg-gray-100 border-b border-gray-100 font-bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span>Profile</span>
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center space-x-2 text-red-600 hover:bg-red-50 font-bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Log Out</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-none border-2 border-black bg-white text-black hover:bg-brand-purple hover:text-white transition-colors shadow-retro-nav active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t-4 border-black bg-white">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @if (Auth::user()->role == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                    class="block w-full pl-3 pr-4 py-3 border-l-4 text-base font-bold uppercase transition focus:outline-none {{ request()->routeIs('admin.dashboard') ? 'border-brand-purple text-brand-purple bg-purple-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')"
                    class="block w-full pl-3 pr-4 py-3 border-l-4 text-base font-bold uppercase transition focus:outline-none {{ request()->routeIs('admin.products.*') ? 'border-brand-purple text-brand-purple bg-purple-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Manajemen Menu
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.tables.index')" :active="request()->routeIs('admin.tables.*')"
                    class="block w-full pl-3 pr-4 py-3 border-l-4 text-base font-bold uppercase transition focus:outline-none {{ request()->routeIs('admin.tables.*') ? 'border-brand-purple text-brand-purple bg-purple-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Manajemen Meja
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')"
                    class="block w-full pl-3 pr-4 py-3 border-l-4 text-base font-bold uppercase transition focus:outline-none {{ request()->routeIs('admin.users.*') ? 'border-brand-purple text-brand-purple bg-purple-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Manajemen User
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')"
                    class="block w-full pl-3 pr-4 py-3 border-l-4 text-base font-bold uppercase transition focus:outline-none {{ request()->routeIs('admin.reports.*') ? 'border-brand-purple text-brand-purple bg-purple-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Laporan
                </x-responsive-nav-link>
            
            @elseif (Auth::user()->role == 'karyawan')
                <x-responsive-nav-link :href="route('pos.index')" :active="request()->routeIs('pos.*')"
                    class="block w-full pl-3 pr-4 py-3 border-l-4 text-base font-bold uppercase transition focus:outline-none {{ request()->routeIs('pos.*') ? 'border-brand-purple text-brand-purple bg-purple-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    POS (Kasir)
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t-4 border-black bg-brand-yellow">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 bg-black text-white flex items-center justify-center font-bold border-2 border-white">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ml-3">
                    <div class="font-bold text-base text-black uppercase">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                @if (Auth::user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.profile.edit')"
                        class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-bold text-gray-800 hover:text-black hover:bg-white hover:border-black uppercase">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-bold text-red-600 hover:text-red-800 hover:bg-white hover:border-red-600 uppercase">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>