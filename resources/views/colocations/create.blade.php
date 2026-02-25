{{-- @extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 flex items-center justify-center px-4">
    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="relative bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">

            {{-- Subtle top accent line --}}
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
                    <h1 class="text-xl font-semibold text-zinc-100 tracking-tight">Create Colocation</h1>
                    <p class="text-sm text-zinc-500 mt-1">Fill in the details to create a new colocation entry.</p>
                </div>

                {{-- Form --}}
                <form action="{{ route('colocations.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">
                            Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Enter colocation name"
                            class="w-full bg-zinc-800/60 border border-zinc-700 text-zinc-100 placeholder-zinc-500
                                   rounded-xl px-4 py-2.5 text-sm
                                   transition duration-150
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50
                                   hover:border-zinc-600
                                   @error('name') border-red-500/60 focus:ring-red-500/40 @enderror"
                        >

                        @error('name')
                            <p class="mt-2 text-xs text-red-400 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                          clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

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
                            Create Colocation
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- Footer link --}}
        <p class="text-center text-xs text-zinc-600 mt-6">
            <a href="{{ url()->previous() }}" class="hover:text-zinc-400 transition-colors duration-150">← Go back</a>
        </p>

    </div>
</div>
@endsection --}}