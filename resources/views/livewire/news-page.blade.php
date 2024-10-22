<div>
    <h1 class="text-3xl font-bold mb-6">Latest News</h1>

    <div class="mb-4 flex gap-4 items-center">
        {{-- Search Input --}}
        <x-bladewind::input
            type="text"
            label="Search News"
            wire:model.defer="search"
            placeholder="Search news articles..."
            class="flex-1" />

        {{-- Search Button --}}
        <x-bladewind::button wire:click="performSearch" class="ml-2">
            Search
        </x-bladewind::button>
    </div>

    {{-- Category Filter --}}
    <x-bladewind::select
        label="Category"
        wire:model="category_id">
        <option value="">All Categories</option>
        <option value="1">Politics</option>
        <option value="2">Sports</option>
        <option value="3">Technology</option>
    </x-bladewind::select>

    {{-- News Items --}}
    <div class="space-y-6 mt-4">
        @forelse ($news as $item)
        <div class="border-b border-gray-300 pb-4">
            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                class="w-full h-48 object-cover rounded-lg mb-4">

            <h2 class="text-2xl font-semibold">{{ $item['title'] }}</h2>
            <p class="text-gray-600">By {{ $item['author'] }} on {{ $item['created_at'] }}</p>
            <p class="mt-2 text-gray-800">{{ $item['description'] }}</p>

            <a href="#" class="text-blue-500 hover:underline">Read more</a>
        </div>
        @empty
        <p class="text-gray-500">No news articles found.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
    </div>
</div>