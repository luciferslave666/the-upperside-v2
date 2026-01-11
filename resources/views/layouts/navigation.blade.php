<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @php
                        $homeRoute = Auth::user()->role == 'admin' ? route('admin.dashboard') : route('pos.index');
                    @endphp
                    <a href="{{ $homeRoute }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="font-bold text-xl text-white">U</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-lg text-gray-900 leading-tight">The Upperside</span>
                            <span class="text-[10px] text-gray-500">System v1.0</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex sm:items-center sm:gap-1">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.dashboard') 
                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} 
                                px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.products.index') }}" 
                           class="{{ request()->routeIs('admin.products.*') 
                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} 
                                px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Menu
                        </a>

                        <a href="{{ route('admin.tables.index') }}" 
                           class="{{ request()->routeIs('admin.tables.*') 
                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} 
                                px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Meja
                        </a>

                        <a href="{{ route('admin.users.index') }}" 
                           class="{{ request()->routeIs('admin.users.*') 
                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} 
                                px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            User
                        </a>

                        <a href="{{ route('admin.reports.index') }}" 
                           class="{{ request()->routeIs('admin.reports.*') 
                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} 
                                px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Laporan
                        </a>
                    
                    @elseif (Auth::user()->role == 'karyawan')
                        <a href="{{ route('pos.index') }}" 
                           class="{{ request()->routeIs('pos.*') 
                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} 
                                px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                            Kasir (POS)
                        </a>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-colors border border-gray-200">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-gradient-to-br from-gray-600 to-gray-700 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>

                            @if (Auth::user()->role == 'admin')
                                <x-dropdown-link :href="route('admin.profile.edit')" class="flex items-center gap-2 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>Profile</span>
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center gap-2 text-red-600 hover:bg-red-50 border-t border-gray-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Log Out</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile menu button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @if (Auth::user()->role == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                    class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.dashboard') ? 'border-blue-600 text-blue-700 bg-blue-50 font-medium' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Dashboard
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')"
                    class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.products.*') ? 'border-blue-600 text-blue-700 bg-blue-50 font-medium' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Menu
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.tables.index')" :active="request()->routeIs('admin.tables.*')"
                    class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.tables.*') ? 'border-blue-600 text-blue-700 bg-blue-50 font-medium' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Meja
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')"
                    class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.users.*') ? 'border-blue-600 text-blue-700 bg-blue-50 font-medium' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    User
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')"
                    class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.reports.*') ? 'border-blue-600 text-blue-700 bg-blue-50 font-medium' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    Laporan
                </x-responsive-nav-link>
            
            @elseif (Auth::user()->role == 'karyawan')
                <x-responsive-nav-link :href="route('pos.index')" :active="request()->routeIs('pos.*')"
                    class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('pos.*') ? 'border-blue-600 text-blue-700 bg-blue-50 font-medium' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }}">
                    POS (Kasir)
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 bg-gradient-to-br from-gray-600 to-gray-700 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                @if (Auth::user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.profile.edit')"
                        class="block w-full pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white rounded-lg">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full pl-3 pr-4 py-2 text-base font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>