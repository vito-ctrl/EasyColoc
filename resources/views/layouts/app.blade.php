<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased selection:bg-indigo-500/30">
        
        <div class="min-h-screen bg-zinc-950">
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @isset($header)
            <header class="bg-zinc-900/50 border-b border-zinc-800/50 backdrop-blur-xl sticky top-0 z-40">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset
            
            <!-- Page Content -->
            <main>
                @if(session('error'))
                    <div class="max-w-4xl mx-auto mt-4 px-4">
                        <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="max-w-4xl mx-auto mt-4 px-4">
                        <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </body>
</html>
