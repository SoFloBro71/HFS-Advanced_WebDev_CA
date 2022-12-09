<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Publisher') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.games.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title')"></x-text-input>


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
                        :value="@old('developer')"></x-text-input>

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
                        {{-- hold previously entered info to save time of text field is missed --}}
                        >{{@old('description')}}</textarea>


                        {{-- displays error message showing that text input is missing--}}
                        @if ($errors->has('description'))
                        <p class="error">{{$errors->first('description')}}</p>
                    @endif

                    {{-- creates a dropdown menu for category options --}}
                        <select name="category" id="category" field="category">
                            <option value="">Select Genre</option>
                            <option value="horror">Horror</option>
                            <option value="act-ad">Action-Adventure</option>
                            <option value="thriller">Thriller</option>
                            <option value="evg">Episodic Video Game</option>
                            <option value="puzzle">Puzzle</option>
                            <option value="rgp">RPG</option>
                        </select>

                        {{-- allows you to choose image file--}}
                        <input
                        type="file"
                        name="game_image"
                        field="game_image"
                        placeholder="Game Cover"
                        class="w-full mt-6">
                    
                        <div class="form-group">
                            <label for="publisher">Publisher</label>
                            <select name="publisher_id">
                                @foreach ($publishers as $publisher)
                                <option value="{{$publisher->id}}" {{(old('publisher_id') == $publisher_id) ? "selected" : ""}}>
                                    {{$publisher->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    <x-primary-button class="mt-6">Save Game</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>