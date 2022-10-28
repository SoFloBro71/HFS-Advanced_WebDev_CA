
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('games.update', $game) }}" method="post">
                    @method('put')
                    @csrf
                    <x-text-input
                    type="text"
                    name="title"
                    field="title"
                    placeholder="Title"
                    class="w-full"
                    autocomplete="off"
                    :value="@old('title')"></x-text-input>

                    <x-text-input
                    type="text"
                    name="developer"
                    field="developer"
                    placeholder="Developer"
                    class="w-full"
                    autocomplete="off"
                    :value="@old('developer')"></x-text-input>

                    <textarea
                    name="description"
                    rows="10"
                    field="description"
                    placeholder="Start typing here..."
                    class="w-full mt-6"
                    >{{@old('description')}}</textarea>

                    <select name="category" id="category" field="category">
                        <option value="">{{($games->genre === '') ? 'Selected' : ''}} Select Genre</option>
                        <option value="horror" {{($games->genre === 'horror') ? 'Selected' : ''}}>Horror</option>
                        <option value="act-ad" {{($games->genre === 'act-ad') ? 'Selected' : ''}}>Action-Adventure</option>
                        <option value="thriller" {{($games->genre === 'thriller') ? 'Selected' : ''}}>Thriller</option>
                        <option value="evg" {{($games->genre === 'evg') ? 'Selected' : ''}}>Episodic Video Game</option>
                        <option value="puzzle" {{($games->genre === 'puzzle') ? 'Selected' : ''}}>Puzzle</option>
                        <option value="rgp" {{($games->genre === 'rpg') ? 'Selected' : ''}}>RPG</option>
                    </select>

                    <input
                    type="file"
                    name="game_image"
                    field="game_image"
                    placeholder="Game Cover"
                    class="w-full mt-6"
                    
                    />

                    <x-primary-button class="mt-6">Save Game</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>