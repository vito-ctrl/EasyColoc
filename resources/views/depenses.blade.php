@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-zinc-950 px-4 py-12">
        <div class="max-w-5xl mx-auto space-y-10">
            
            {{-- Header section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-bold text-zinc-100 tracking-tight">depenses</h1>
                    <p class="text-zinc-500 mt-2 text-lg">Manage your depenses and pending requests.</p>
                </div>
                <a href="{{ route('colocations.create') }}" 
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 active:scale-[0.98]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New depense
                </a>
            </div>
        </div>
    </div>
@endsection