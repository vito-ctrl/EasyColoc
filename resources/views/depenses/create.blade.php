@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 flex items-center justify-center px-4">
    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="relative bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">

            {{-- Top accent --}}
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500/60 to-transparent"></div>

            <div class="px-8 py-10">

                {{-- Header --}}
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 mb-4">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-semibold text-zinc-100 tracking-tight">Create Expense</h1>
                    <p class="text-sm text-zinc-500 mt-1">Add a new expense to this colocation.</p>
                </div>

                {{-- Form --}}
                <form action="{{ route('depense.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2">
                            Title
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            placeholder="Groceries, Electricity..."
                            class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100 placeholder-zinc-500
                                   rounded-xl px-4 py-2.5 text-sm
                                   transition duration-150
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50
                                   hover:border-zinc-600
                                   @error('title') border-red-500/60 focus:ring-red-500/40 @enderror"
                        >
                        @error('title')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2">
                            Amount
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            value="{{ old('amount') }}"
                            required
                            placeholder="0.00"
                            class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100
                                   rounded-xl px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/50
                                   @error('amount') border-red-500/60 focus:ring-red-500/40 @enderror"
                        >
                        @error('amount')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2">
                            Date
                        </label>
                        <input
                            type="date"
                            name="date"
                            value="{{ old('date') }}"
                            required
                            class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100
                                   rounded-xl px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/50
                                   @error('date') border-red-500/60 focus:ring-red-500/40 @enderror"
                        >
                        @error('date')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Payer --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2">
                            Payer
                        </label>
                        <select
                            name="payer_id"
                            required
                            class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100
                                   rounded-xl px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/50
                                   @error('payer_id') border-red-500/60 focus:ring-red-500/40 @enderror"
                        >
                            <option value="">Select payer</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('payer_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('payer_id')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-2">
                            Category
                        </label>
                        <select
                            name="category_id"
                            class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100
                                   rounded-xl px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/50
                                   @error('category_id') border-red-500/60 focus:ring-red-500/40 @enderror"
                        >
                            <option value="">No category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hidden colocation --}}
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700
                                   text-white text-sm font-medium
                                   px-4 py-2.5 rounded-xl
                                   transition duration-150 ease-in-out
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-zinc-900
                                   shadow-lg shadow-indigo-500/10"
                        >
                            Create Expense
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <p class="text-center text-xs text-zinc-600 mt-6">
            <a href="{{ url()->previous() }}" class="hover:text-zinc-400 transition-colors duration-150">← Go back</a>
        </p>

    </div>
</div>
@endsection
