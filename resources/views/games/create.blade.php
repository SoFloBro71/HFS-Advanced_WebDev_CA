<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('games.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title')"></x-text-input>

                        @if ($errors->has('title'))
                        <p class="error">{{$errors->first('title')}}</p>
                    @endif

                        <x-text-input
                        type="text"
                        name="developer"
                        field="developer"
                        placeholder="Developer"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('developer')"></x-text-input>

                        @if ($errors->has('developer'))
                        <p class="error">{{$errors->first('developer')}}</p>
                    @endif

                        <textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="Start typing here..."
                        class="w-full mt-6"
                        >{{@old('description')}}</textarea>

                        @if ($errors->has('description'))
                        <p class="error">{{$errors->first('description')}}</p>
                    @endif

                        <select name="category" id="category" field="category">
                            <option value="">Select Genre</option>
                            <option value="horror">Horror</option>
                            <option value="act-ad">Action-Adventure</option>
                            <option value="thriller">Thriller</option>
                            <option value="evg">Episodic Video Game</option>
                            <option value="puzzle">Puzzle</option>
                            <option value="rgp">RPG</option>
                        </select>



                        <input
                        type="file"
                        name="game_image"
                        field="game_image"
                        placeholder="Game Cover"
                        class="w-full mt-6">
                    


                    <x-primary-button class="mt-6">Save Game</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>