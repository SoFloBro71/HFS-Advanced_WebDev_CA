{{-- pulls fonts from google fonts and applies them to page --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font">
            {{ __('Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>

                {{-- displays success message if new game is created--}}
                {{session('success')}}

            </x-alert-success> 

            @forelse ($games as $game)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg flex">
                    <div>
                        <h2 class="text">
                            {{-- displays info entered saved from database--}}
                            <a href="{{ route('user.games.show', $game) }}">{{ $game->title }}</a>
                            <p>{{ $game->developer }}</p>
                            <p>{{ $game->description }}</p>
                            <p>{{ $game->category }}</p>
                        </h2>
                        <p class="mt-2">
                            {{ Str::limit($game->text, 200) }}
                        </p>
                        <span class="block mt-4 text-sm opacity-70">{{ $game->updated_at->diffForHumans() }}</span>
                    </div>
                        <img src="{{asset('storage/images/' . $game->game_image)}}" width="400" />
                </div>
            @empty
            <p>You have no Games yet.</p>
            @endforelse
            {{$games->links()}}
        </div>
    </div>
</x-app-layout>