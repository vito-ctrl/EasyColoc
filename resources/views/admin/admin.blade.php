@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 px-4 py-12">
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-bold text-zinc-100 tracking-tight">Admin Dashboard</h1>
                <p class="text-zinc-500 mt-2 text-lg">Platform statistics overview</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" 
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 active:scale-[0.98]">
                
                bann users
            </a>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Total Users --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <span class="text-zinc-500 text-sm uppercase">Total Users</span>
                <h2 class="text-3xl font-bold text-zinc-100 mt-2">{{ $totalUsers }}</h2>
            </div>

            {{-- Total Colocations --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <span class="text-zinc-500 text-sm uppercase">Total Colocations</span>
                <h2 class="text-3xl font-bold text-zinc-100 mt-2">{{ $totalColocations }}</h2>
            </div>

            {{-- Active Colocations --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <span class="text-zinc-500 text-sm uppercase">Active Colocations</span>
                <h2 class="text-3xl font-bold text-zinc-100 mt-2">{{ $activeColocations }}</h2>
            </div>

            {{-- Active Members --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <span class="text-zinc-500 text-sm uppercase">Active Members</span>
                <h2 class="text-3xl font-bold text-zinc-100 mt-2">{{ $totalActiveMembers }}</h2>
            </div>

            {{-- Pending Invitations --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <span class="text-zinc-500 text-sm uppercase">Pending Invitations</span>
                <h2 class="text-3xl font-bold text-amber-400 mt-2">{{ $pendingInvitations }}</h2>
            </div>

            {{-- Total Expenses --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <span class="text-zinc-500 text-sm uppercase">Total Expenses</span>
                <h2 class="text-3xl font-bold text-indigo-400 mt-2">{{ $totalExpenses }}</h2>
            </div>

            {{-- Total Money Spent --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col col-span-1 md:col-span-2 lg:col-span-3">
                <span class="text-zinc-500 text-sm uppercase">Total Money Spent</span>
                <h2 class="text-4xl font-bold text-green-400 mt-2">{{ number_format($totalAmountSpent, 2) }} €</h2>
            </div>
        </div>

        {{-- Recent Users & Colocations --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Recent Users --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <h3 class="text-lg font-semibold text-zinc-100 mb-4">Recent Users</h3>
                <ul class="divide-y divide-zinc-800/50">
                    @foreach($recentUsers as $user)
                        <li class="py-3 flex justify-between items-center">
                            <span class="text-zinc-300">{{ $user->name }}</span>
                            <span class="text-zinc-500 text-sm">{{ $user->created_at->format('d M Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Recent Colocations --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-lg shadow-black/20 flex flex-col">
                <h3 class="text-lg font-semibold text-zinc-100 mb-4">Recent Colocations</h3>
                <ul class="divide-y divide-zinc-800/50">
                    @foreach($recentColocations as $colocation)
                        <li class="py-3 flex justify-between items-center">
                            <span class="text-zinc-300">{{ $colocation->name }}</span>
                            <span class="text-zinc-500 text-sm">{{ $colocation->created_at->format('d M Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            @foreach($users as $user)
                <div class="flex justify-between items-center py-2 px-4 bg-zinc-900 border border-zinc-800 rounded-xl mb-2">
                    <span class="text-zinc-100">{{ $user->name }} ({{ $user->email }})</span>

                    <form method="POST" action="{{ $user->isBanned() ? route('admin.users.unban', $user->id) : route('admin.users.ban', $user->id) }}">
                        @csrf
                        <button type="submit" 
                            class="px-4 py-1 rounded-lg text-sm font-semibold
                                {{ $user->isBanned() ? 'bg-green-600 hover:bg-green-500 text-white' : 'bg-red-600 hover:bg-red-500 text-white' }}">
                            {{ $user->isBanned() ? 'Unban' : 'Ban' }}
                        </button>
                    </form>
                </div>
            @endforeach


        </div>

    </div>
</div>
@endsection
