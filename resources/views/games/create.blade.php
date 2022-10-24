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

                        <x-text-input
                        type="text"
                        name="developer"
                        field="developer"
                        placeholder="Developer"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title')"></x-text-input>

                    <x-textarea
                        name="text"
                        rows="10"
                        field="description"
                        placeholder="Start typing here..."
                        class="w-full mt-6"
                        :value="@old('description')"></x-textarea>

                        <x-text-input
                        type="text"
                        name="categoery"
                        field="category"
                        placeholder="Category"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title')"></x-text-input>

                        <x-text-input
                        type="file"
                        name="game_image"
                        field="game_image"
                        placeholder="Game Cover"
                        class="w-full mt-6">
                        </x-text-input>

                    <x-primary-button class="mt-6">Save Game</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>