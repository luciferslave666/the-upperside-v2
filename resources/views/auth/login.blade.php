<x-guest-layout>
    
    @vite('resources/css/app.css')

    <div class="min-h-screen flex items-center justify-center bg-brand-yellow py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden font-body text-brand-black">
        
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 20px 20px;"></div>

        <div class="absolute top-10 right-10 w-24 h-24 bg-brand-purple border-4 border-black rotate-12 hidden md:block animate-bounce" style="animation-duration: 3s;"></div>
        <div class="absolute bottom-10 left-10 w-16 h-16 bg-white border-4 border-black rounded-full hidden md:block"></div>

        <div class="max-w-md w-full relative z-10">
            
            <div class="text-center mb-8 transform -rotate-1">
                <div class="w-20 h-20 bg-black text-white mx-auto flex items-center justify-center border-4 border-white shadow-retro mb-4">
                    <span class="font-display text-4xl">U</span>
                </div>
                
                <h2 class="font-display text-4xl uppercase leading-none mb-2">
                    Admin <span class="text-brand-purple bg-black px-2 inline-block transform skew-x-[-10deg]">Panel</span>
                </h2>
                <p class="font-bold text-gray-800 uppercase tracking-widest text-xs">
                    The Upperside • Secure Login
                </p>
            </div>

            <x-auth-session-status class="mb-4 bg-brand-purple text-white p-3 border-2 border-black font-bold text-center shadow-retro-sm" :status="session('status')" />

            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-32 h-6 bg-gray-200/50 border-2 border-black rotate-2"></div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block font-display text-sm uppercase mb-2">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input id="email" 
                                   class="block w-full pl-10 pr-3 py-3 bg-gray-100 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-500 font-bold" 
                                   type="email" 
                                   name="email" 
                                   :value="old('email')" 
                                   required 
                                   autofocus 
                                   autocomplete="username"
                                   placeholder="admin@theupperside.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-600 uppercase bg-red-100 p-1 border border-red-500 inline-block" />
                    </div>

                    <div>
                        <label for="password" class="block font-display text-sm uppercase mb-2">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" 
                                   class="block w-full pl-10 pr-3 py-3 bg-gray-100 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-500 font-bold"
                                   type="password"
                                   name="password"
                                   required 
                                   autocomplete="current-password"
                                   placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-600 uppercase bg-red-100 p-1 border border-red-500 inline-block" />
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="w-5 h-5 rounded-none border-2 border-black text-black focus:ring-0 cursor-pointer" 
                               name="remember">
                        <label for="remember_me" class="ml-2 text-sm font-bold text-gray-700 cursor-pointer select-none">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center items-center py-4 px-4 bg-black text-white font-display uppercase tracking-widest border-2 border-transparent hover:bg-white hover:text-black hover:border-black hover:shadow-retro-sm transition-all duration-200 active:translate-y-1 active:shadow-none">
                            {{ __('Log in') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a class="text-xs font-bold uppercase text-gray-500 hover:text-black hover:underline decoration-2 underline-offset-2" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif

                </form>
            </div>
            
            <p class="text-center mt-8 font-bold text-xs uppercase tracking-widest opacity-60">
                &copy; {{ date('Y') }} The Upperside System
            </p>

        </div>
    </div>
</x-guest-layout>