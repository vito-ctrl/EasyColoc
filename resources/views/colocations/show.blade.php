@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 flex items-start justify-center px-4 py-12">
    <div class="w-full max-w-lg space-y-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <a href="{{ route('depense.create', $colocation->id) }}" 
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 active:scale-[0.98]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New depense
            </a>
        </div>

        <form action="{{ route('categories.store', $colocation->id) }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="WIFI" required
                class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-2.5 text-sm">

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                Create Category
            </button>
        </form>


        {{-- Header Card --}}
        <div class="relative bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500/60 to-transparent"></div>
            <div class="px-8 py-7 flex items-center gap-4">
                <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex-shrink-0">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-zinc-500 uppercase tracking-widest mb-0.5">Colocation</p>
                    <h1 class="text-xl font-semibold text-zinc-100 tracking-tight">{{ $colocation->name }}</h1>
                </div>
            </div>
        </div>

        {{-- Members Card --}}
        <div class="relative bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-zinc-600/40 to-transparent"></div>

            <div class="px-8 pt-7 pb-2">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-sm font-semibold text-zinc-300 uppercase tracking-widest">Members</h2>
                    <span class="text-xs text-zinc-500 bg-zinc-800 border border-zinc-700 rounded-full px-2.5 py-0.5">
                        {{ $colocation->members->whereNull('pivot.left_at')->count() }}
                    </span>
                </div>

                @if($colocation->members->whereNull('pivot.left_at')->isEmpty())
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <div class="w-10 h-10 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-zinc-500">No active members yet.</p>
                    </div>
                @else
                    <ul class="divide-y divide-zinc-800/80">
                        {{-- {{dd($members)}} --}}
                        @foreach($members as $member)
                            <li class="flex items-center justify-between py-3.5 group">
                                <div class="flex items-center gap-3">
                                    {{-- Avatar initials --}}
                                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-semibold text-zinc-400">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-zinc-300 group-hover:text-zinc-100 transition-colors duration-150">
                                            {{ $member->name }}
                                        </span>
                                        <span class="text-xs text-zinc-500">
                                            {{ ucfirst($member->pivot->role) }}
                                        </span>
                                        <span class="
                                            {{ $member->balance > 0 ? 'text-emerald-400' : 
                                            ($member->balance < 0 ? 'text-red-400' : 'text-zinc-400') }}
                                        ">
                                            {{ number_format($member->balance, 2) }} €
                                        </span>
                                    </div>
                                </div>

                                {{-- Status badge --}}
                                @php
                                    $status = $member->pivot->status;
                                    $badgeClass = match($status) {
                                        'accepted' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                        'pending'  => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                        default    => 'bg-zinc-700/40 text-zinc-500 border-zinc-700',
                                    };
                                @endphp
                                <span class="inline-flex items-center text-xs font-medium px-2.5 py-0.5 rounded-full border {{ $badgeClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="h-4"></div>
        </div>

        {{-- Invite Card - only for owner --}}
        @if(auth()->id() === $colocation->owner_id)
            <div class="relative bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500/60 to-transparent"></div>

                <div class="px-8 py-7">
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 mb-4">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-zinc-100 tracking-tight">Invite a User</h2>
                        <p class="text-sm text-zinc-500 mt-1">Send an invite link to a user's email address.</p>
                    </div>

                    <form action="{{ route('colocations.invite', $colocation->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="email" name="email" placeholder="colleague@example.com" required
                               class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-2.5 text-sm">
                        <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                            Send Invite
                        </button>
                    </form>
                </div>
            </div>
        @endif

        {{-- Leave button --}}
        <div class="mt-8 border-t border-zinc-800/50 pt-8">
            <form action="{{ route('colocations.leave', $colocation->id) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-zinc-900 border border-zinc-800 hover:border-red-500/50 hover:bg-red-500/5 text-zinc-500 hover:text-red-400 text-sm font-medium px-4 py-2.5 rounded-xl transition-all duration-200"
                        onclick="return confirm('Are you sure you want to leave this colocation?')">
                    Leave Colocation
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <p class="text-center text-xs text-zinc-600 mt-4">
            <a href="{{ url()->previous() }}" class="hover:text-zinc-400 transition-colors duration-150">← Go back</a>
        </p>

    </div>
</div>
@endsection
