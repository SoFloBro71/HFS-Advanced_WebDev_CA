
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>

                {{session('success')}}

            </x-alert-success> 
            
            <a href="{{ route('games.create') }}" class="btn-link btn-lg mb-2">+ New Game</a>
            @forelse ($games as $game)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('games.show', $game) }}">{{ $game->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ Str::limit($game->text, 200) }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">{{ $game->updated_at->diffForHumans() }}</span>
                </div>
            @empty
            <p>You have no Games yet.</p>
            @endforelse
            {{$games->links()}}
        </div>
    </div>
</x-app-layout>