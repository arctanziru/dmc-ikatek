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
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search Disaster..."
                        class="text-[12px] flex-1 max-w-md rounded-md" wire:keydown.enter="performSearch" />

                    {{-- Per Page Dropdown --}}
                    <div class="flex min-w-[60px]">
                        <select wire:model.live.debounce.150ms="perPage" class="border rounded p-2 w-full text-[12px]">
                            @foreach($perPageData as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a class="min-w-max" href="/disaster/report">
                    <x-button variant="outlined" color="dark" rounded="none" class="hidden md:flex">Report Disaster
                        +</x-button>
                </a>
            </div>
            <a href="/disaster/report" class="w-full">
                <x-button variant="outlined" size="medium" color="dark" rounded="none"
                    class="inline md:hidden w-full text-[12px]">Report Disaster +</x-button>
            </a>
        </div>

        {{-- Disaster Items --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-[1440px]">
            @forelse ($disasters as $disaster)
                <x-disaster-card :disaster="$disaster" />
            @empty
                <p class="text-gray-500 w-screen">No disaster reported.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $disasters->links() }}
        </div>
    </div>
</main>