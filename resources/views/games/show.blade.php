
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
            
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $game->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{ $game->updated_at->diffForHumans() }}
                </p>
                <a href="{{ route('games.edit', $game) }}" class="btn-link ml-auto">Edit Game</a>
                <form action="{{ route('games.destroy', $game) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this Game?')">Delete Game</button>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $game->title }}
                </h2>
                <p class="mt-6 whitespace-">{{$game->text}}</p>
            </div>
        </div>
    </div>
</x-app-layout>