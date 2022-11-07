
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

                    {{-- shows timestamp of when game was created --}}
                    <strong>Created: </strong> {{ $game->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">

                    {{-- shows timestamp of when game was last updated --}}
                    <strong>Updated at: </strong> {{ $game->updated_at->diffForHumans() }}

                    {{-- takes you to edit page --}}
                </p>
                <a href="{{ route('games.edit', $game) }}" class="btn-link ml-auto">Edit Game</a>
                <form action="{{ route('games.destroy', $game) }}" method="post">
                    @method('delete')

                    {{-- displays popup allowing you the chance to either confirm yuor choice to delete a game or change your mind--}}
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this Game?')">Delete Game</button>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td rowspan="6">
                                {{-- displays information by id and image associated with it --}}
                                <img src="{{asset('storage/images/' . $game->game_image)}}" width="150"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">Title </td>
                            <td> {{ $game->title}}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Developer </td>
                            <td> {{ $game->developer}}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Description </td>
                            <td> {{ $game->description}}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Category </td>
                            <td >{{ $game->category}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>