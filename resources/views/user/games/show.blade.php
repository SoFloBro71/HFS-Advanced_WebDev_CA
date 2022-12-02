
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
{{-- makes success banner if game is made--}}
            <x-alert-success>
                {{session('success')}}

            </x-alert-success> 

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