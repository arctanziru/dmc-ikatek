@php
$categoryOptions = $categories->map(function ($category) {
return [
'label' => $category->name,
'value' => $category->id,
];
})->toArray();
@endphp
<main class="flex flex-col justify-center items-center">
    <div class="flex flex-col p-4 md:p-8 lg:p-12 max-w-[1440px] gap-8">
        <div class="w-full items-center flex justify-center">
            <h1 class="text-[36px] font-bold">Latest News</h1>
        </div>

        <div class="flex gap-4 w-full justify-start">
            {{-- Search Input --}}
            <div class="flex gap-3 items-center">
                {{-- Search Field --}}
                <input type="text" label="Search News" wire:model.defer="search" placeholder="Search news articles..."
                    class="text-[12px] rounded-md" wire:keydown.enter="performSearch" />

                {{-- Category Filter --}}
                <div class="flex max-w-[180px]">
                    <select wire:model.defer="category_id" wire:change="updateCategoryAndFetchNews" class="border rounded p-2 w-full text-[12px]">
                        <option value="">All Categories</option>
                        @foreach($categoryOptions as $option)
                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Search Button (Manually perform search) --}}
                <x-button wire:click="performSearch" color="dark" class="h-max" size="medium" variant="outlined"
                    rounded="none">
                    <p class="text-[12px]">Search</p>
                </x-button>

                {{-- Cancel Button (Resets Filters) --}}
                @if($search || $category_id)
                {{-- Cancel Button (Redirects to /news) --}}
                <x-button onclick="window.location='/news'" color="dark" class="h-max" size="medium" variant="outlined"
                    rounded="none">
                    <p class="text-[12px]">Clear </p>
                </x-button>
                @endif
            </div>
        </div>


        {{-- News Items --}}
        <div class=" grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-[1440px]  ">
            @forelse ($news as $item)
            <a href="news/{{$item["id"]}}"
                class="flex shadow-sm overflow-hidden shadow-dark/20 cursor-pointer flex-col hover:bg-white-light transition-[200ms] hover:transition-[200ms]">
                <div class="min-w-full  h-[140px] rounded-lg bg-white-light">

                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-[140px] object-cover ">
                </div>

                <div class="flex flex-col justify-between p-3 gap-2">
                    <div class="flex justify-between w-full">
                        <div class="flex gap-2 items-center flex-1 min-w-max justify-start text-right">
                            <img src="icons/authors.svg" class="h-3" alt="Author Icon" />
                            <p class="text-dark font-light text-[12px]">{{ $item['author'] }}</p>
                        </div>
                        <div class="flex gap-2 items-center flex-1 min-w-max justify-end text-right">
                            <img src="icons/date.svg" class="h-3" alt="Author Icon" />
                            <p class="text-dark font-light text-[12px]">
                                {{ (new DateTime($item['created_at']))->format(format: 'd M Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2 items-center">
                        <img src="icons/label.svg" class="h-3" alt="Author Icon" />
                        <p class="text-dark font-semibold capitalize text-ellipsis line-clamp-1 text-[12px]">
                            {{ collect($categoryOptions)->firstWhere('value', $item['news_category_id'])['label'] ?? 'Unknown Category' }}
                        </p>
                    </div>
                    <p class="text-[20px] leading-6 text-ellipsis line-clamp-2 font-semibold">{{ $item['title'] }}</p>

                    <p class="text-dark text-[12px] line-clamp-2">{{ $item['description'] }}</p>

                </div>
            </a>
            @empty
            <p class="text-gray-500 w-screen">No news articles found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="w-full flex justify-center">
            @if ($pagination['total_pages'] > 1)
            <div class="flex gap-2">
                {{-- Previous Page Link --}}
                @if ($pagination['current_page'] > 1)

                <x-button rounded="none" variant="fill" color="dark" size="small"
                    class="flex justify-center items-center"
                    wire:click="$set('page', {{ $pagination['current_page'] - 1 }})">
                    Previous
                </x-button>

                @else

                <x-button rounded="none" variant="fill" color="dark" disabled size="small"
                    class=" flex justify-center items-center">
                    Previous
                </x-button>

                @endif

                {{-- Page Number Links --}}
                @for ($i = 1; $i <= $pagination['total_pages']; $i++)

                    <x-button rounded="none" variant="{{ $pagination['current_page'] == $i ? 'fill' : 'outlined' }}"
                    color="primary" wire:click="$set('page', {{ $i }})" size="small"
                    class="h-8 w-8 font-bold flex justify-center items-center">
                    {{ $i }}
                    </x-button>

                    @endfor

                    {{-- Next Page Link --}}
                    @if ($pagination['current_page'] < $pagination['total_pages'])

                        <x-button rounded="none" variant="fill" color="dark"
                        wire:click="$set('page', {{ $pagination['current_page'] + 1 }})" size="small"
                        class=" flex justify-center items-center">
                        Next
                        </x-button>

                        @else

                        <x-button rounded="none" variant="fill" color="dark" size="small"
                            class=" flex justify-center items-center" disabled>
                            Next
                        </x-button>

                        @endif


                        </di>
                        @endif
            </div>


        </div>
</main>