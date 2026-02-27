@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-zinc-950 px-4 py-12">
        <div class="max-w-5xl mx-auto space-y-10">
            
            {{-- Header section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-bold text-zinc-100 tracking-tight">Dashboard</h1>
                    <p class="text-zinc-500 mt-2 text-lg">Manage your colocations and pending requests.</p>
                </div>
                <a href="{{ route('colocations.create') }}" 
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 active:scale-[0.98]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Colocation
                </a>
            </div>

            {{-- Invitations Section --}}
            @if($invitations->isNotEmpty())
                <div class="space-y-4">
                    <h2 class="text-sm font-semibold text-zinc-400 uppercase tracking-widest pl-1">Pending Invitations</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($invitations as $invitation)
                            <div class="bg-amber-500/5 border border-amber-500/20 rounded-2xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 transition-all hover:bg-amber-500/10">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-zinc-100">Invite to join: {{ $invitation->name }}</h3>
                                        <p class="text-zinc-500 text-sm">You've been invited by {{ $invitation->owner->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('colocations.accept', $invitation->pivot->token) }}"
                                       class="bg-amber-500 hover:bg-amber-400 text-amber-950 px-5 py-2 rounded-lg font-bold text-sm transition-colors shadow-lg shadow-amber-500/20">
                                        Accept Invitation
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Colocations Grid --}}
            <div class="space-y-4">
                <h2 class="text-sm font-semibold text-zinc-400 uppercase tracking-widest pl-1">Your Colocations</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($colocations as $colocation)
                        <div class="group relative bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden transition-all hover:border-zinc-700 hover:shadow-2xl hover:shadow-black/60 flex flex-col">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-indigo-500/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <div class="p-8 flex-1">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 transition-colors group-hover:bg-indigo-500/20">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-zinc-100 group-hover:text-white transition-colors">{{ $colocation->name }}</h3>
                                </div>

                                <div class="space-y-2 mb-8">
                                    <div class="flex items-center text-sm text-zinc-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        {{ $colocation->active_members_count }} active members
                                    </div>
                                </div>
                            </div>

                            <div class="px-8 py-6 bg-zinc-800/20 border-t border-zinc-800/50 flex items-center justify-between mt-auto">
                                <a href="{{ route('colocations.show', $colocation->id) }}" 
                                   class="text-sm font-semibold text-indigo-400 hover:text-indigo-300 transition-colors flex items-center gap-1.5">
                                    Manage
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                
                                <form action="{{ route('colocations.leave', $colocation->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="text-xs font-bold text-zinc-600 hover:text-red-400 transition-colors uppercase tracking-widest"
                                            onclick="return confirm('Are you sure you want to leave this colocation?')">
                                        Leave
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-24 bg-zinc-900/30 border-2 border-dashed border-zinc-800/50 rounded-3xl flex flex-col items-center justify-center text-center px-6">
                            <div class="w-20 h-20 bg-zinc-900 rounded-3xl flex items-center justify-center mb-8 text-zinc-700 border border-zinc-800 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-zinc-200">No active colocations</h3>
                            <p class="text-zinc-500 mt-3 max-w-sm mx-auto text-lg leading-relaxed">It looks like you're not part of any colocation yet. Start by creating one!</p>
                            <a href="{{ route('colocations.create') }}" 
                               class="mt-10 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 px-8 py-3 rounded-xl font-bold transition-all border border-zinc-700 active:scale-95 shadow-lg">
                                Create your first colocation
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection