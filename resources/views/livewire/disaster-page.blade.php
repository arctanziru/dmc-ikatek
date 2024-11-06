@php
    $perPageData = [
        ['label' => '5', 'value' => '5'],
        ['label' => '10', 'value' => '10'],
        ['label' => '15', 'value' => '15'],
        ['label' => '20', 'value' => '20'],
    ]
@endphp

<main class="flex p-4 md:p-8 lg:p-12 flex-col justify-center items-center ">
    <div class="flex flex-col w-full gap-8">
        <div class="w-full items-center flex justify-center">
            <h1 class="text-[36px] font-bold">Latest Disaster</h1>
        </div>

        <div class="flex flex-col gap-4 w-full justify-start items-center">
            {{-- Search Input --}}
            <div class="flex gap-3 items-center justify-between w-full">

                {{-- Search Field --}}
                <div class="flex gap-4 w-full">

                    <input type="text" wire:model.live.debounce.500ms="search" type="text" label="Search News"
                        wire:model.defer="search" placeholder="Search Disaster..."
                        class="text-[12px] w-full md:w-fit rounded-md" wire:keydown.enter="performSearch" />

                    {{-- per data --}}
                    <div class="flex min-w-[60px]">
                        <select wire:model.live.debounce.150ms="perPage" class="border rounded p-2 w-full text-[12px]">
                            @foreach($perPageData as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a class="min-w-max" href="/disaster/report">
                    <x-button variant="outlined" color="dark" rounded="none"
                        class=" hidden md:flex  ">Report Disaster +</x-button>
                </a>


            </div>
            <a href="/disaster/report" class="w-full">
                <x-button variant="outlined" size="medium" color="dark" rounded="none"
                    class=" inline md:hidden  w-full text-[12px] ">Report Disaster +</x-button>
            </a>
        </div>


        {{-- News Items --}}
        <div class=" grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-[1440px]  ">
            @forelse ($disasters as $item)
                <div
                    class="flex shadow-sm overflow-hidden shadow-dark/20 cursor-pointer flex-col hover:bg-white-light transition-[200ms] hover:transition-[200ms]">

                    <div class="flex flex-col justify-between p-3 gap-2">
                        <div class="flex justify-between gap-2">
                            <p class="line-clamp-1 flex-1 font-bold capitalize">{{$item->name}} </p>
                            <p class="line-clamp-1 min-w-fit font-semibold text-[14px] uppercase text-primary">
                                {{$item->status}}
                            </p>
                        </div>
                        <p class="text-dark text-[12px] line-clamp-2">{{ $item['description'] }}</p>
                        <div class="flex justify-between w-full">
                            <div class="flex gap-2 items-center flex-1 min-w-max justify-start text-right">
                                <x-bladewind::icon name="map-pin" class="!h-4 !w-4" />
                                <p class="text-dark font-light text-[12px] line-clamp-1" name="  {{ ucwords(strtolower($item->city->name)) }},
                                         {{ucwords(strtolower($item->city->province->name)) }}">
                                    {{ ucwords(strtolower($item->city->name)) }},
                                    {{ucwords(strtolower($item->city->province->name)) }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-2 items-center flex-1 min-w-max justify-between text-right">
                            <div class="flex gap-1">
                                <x-bladewind::icon name="user" class="!h-4 !w-4" />
                                <p class="text-dark font-light text-[12px]">
                                    {{$item->user->name}}
                                </p>
                            </div>
                            <div class="flex gap-1">
                                <x-bladewind::icon name="calendar-days" class="!h-4 !w-4" />
                                <p class="text-dark font-light text-[12px]">
                                    {{ (new DateTime($item['created_at']))->format(format: 'd M Y') }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <p class="text-gray-500 w-screen">No news articles found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        {{ $disasters->links() }}
</main>