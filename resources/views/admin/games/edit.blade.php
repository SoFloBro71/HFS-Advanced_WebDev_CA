
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.games.update', $game) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <x-text-input
                    type="text"
                    name="title"
                    field="title"
                    placeholder="Title"
                    class="w-full"
                    autocomplete="off"
                    {{-- :value="@old('title')" --}}
                    value="{{ old('title', $game->title) }}"></x-text-input>

                    {{-- displays error message showing that text input is missing--}}
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
                    {{-- :value="@old('developer')" --}}
                    value="{{ old('developer', $game->developer) }}"
                    ></x-text-input>

                    {{-- displays error message showing that text input is missing--}}
                    @if ($errors->has('developer'))
                        <p class="error">{{$errors->first('developer')}}</p>
                    @endif

                    <textarea
                    name="description"
                    rows="10"
                    field="description"
                    placeholder="Start typing here..."
                    class="w-full mt-6"
                    >{{@old('description', $game->description)}}</textarea>

                    {{-- displays error message showing that text input is missing--}}
                    @if ($errors->has('description'))
                    <p class="error">{{$errors->first('description')}}</p>
                @endif

                {{-- creates a dropdown menu for category options and retains previously chosen option from create --}}
                    <select name="category" id="category" field="category">
                        <option value="">{{($game->category === '') ? 'Select Category' : ''}}</option>
                        <option value="horror" {{($game->category === 'horror') ? 'Selected' : ''}}>Horror</option>
                        <option value="act-ad" {{($game->category === 'act-ad') ? 'Selected' : ''}}>Action-Adventure</option>
                        <option value="thriller" {{($game->category === 'thriller') ? 'Selected' : ''}}>Thriller</option>
                        <option value="evg" {{($game->category === 'evg') ? 'Selected' : ''}}>Episodic Video Game</option>
                        <option value="puzzle" {{($game->category === 'puzzle') ? 'Selected' : ''}}>Puzzle</option>
                        <option value="rgp" {{($game->category === 'rpg') ? 'Selected' : ''}}>RPG</option>
                        </select>

                        {{-- displays error message showing that input is missing--}}
                        @if ($errors->has('category'))
                        <p class="error">{{$errors->first('category')}}</p>
                    @endif

                    {{-- allows you to choose image file--}}
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