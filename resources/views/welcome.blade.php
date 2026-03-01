<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'EasyColoc') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-zinc-950 text-zinc-100 selection:bg-indigo-500/30">
        <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
            {{-- Background decorative elements --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-500/10 blur-[120px] rounded-full"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-500/10 blur-[120px] rounded-full"></div>
            </div>

            {{-- Navigation --}}
            <nav class="absolute top-0 w-full px-6 py-8 flex justify-between items-center max-w-7xl mx-auto z-10">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white uppercase">EasyColoc</span>
                </div>
                
                <div class="flex items-center gap-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-zinc-400 hover:text-white transition-colors">Log in</a>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40">Get Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>

            {{-- Hero Section --}}
            <main class="relative z-10 px-6 text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-400 text-xs font-medium mb-8">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
                    Simplifying roommate life for everyone
                </div>
                
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-[1.1]">
                    Manage your colocation <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">without the stress</span>
                </h1>
                
                <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mb-12 leading-relaxed">
                    Track expenses, split bills, and manage household tasks all in one place. EasyColoc helps you focus on living together, not arguing about money.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all shadow-2xl shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:-translate-y-0.5">
                        Start Your Colocation
                    </a>
                    <a href="#features" class="w-full sm:w-auto bg-zinc-900 hover:bg-zinc-800 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all border border-zinc-800 hover:border-zinc-700">
                        See How It Works
                    </a>
                </div>
            </main>

            {{-- Footer --}}
            <footer class="absolute bottom-12 w-full px-6 text-center z-10">
                <p class="text-zinc-600 text-sm">
                    &copy; {{ date('Y') }} EasyColoc. Built with passion for better living.
                </p>
            </footer>
        </div>
    </body>
</html>
