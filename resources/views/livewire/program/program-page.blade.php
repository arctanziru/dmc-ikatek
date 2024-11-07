@php
    $perPageData = [
        ['label' => '5', 'value' => '5'],
        ['label' => '10', 'value' => '10'],
        ['label' => '15', 'value' => '15'],
        ['label' => '20', 'value' => '20'],
    ]
@endphp

<main class="flex flex-col gap-2 md:gap-4 lg:gap-8 p-4 md:p-8 lg:p-12 items-center">
    <main class="flex flex-col gap-2 md:gap-4 lg:gap-8 max-w-[1440px] w-full items-center">

        <!-- Search and Filters -->
        <div class="flex gap-4 justify-start items-center w-full">
            <!-- Search Input -->
            <input type="text" wire:model.live.debounce.500ms="search" type="text" label="Search News"
                wire:model.defer="search" placeholder="Search Disaster..."
                class="text-[12px] flex-1 max-w-md rounded-md" wire:keydown.enter="performSearch" />

            <!-- Status Filter -->
            <div class="flex min-w-[60px]">
                <select wire:model.live.debounce.150ms="perPage" class="border rounded p-2 w-full text-[12px]">
                    @foreach($perPageData as $option)
                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Per Page Selector -->
            <div class="flex min-w-[60px]">
                <select wire:model.live.debounce.150ms="status" class="border rounded p-2 w-20 text-[12px]">
                    <option value="">All Program</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Program Cards -->
        <div
            class="grid grid-cols-1 w-full justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 lg:gap-4">
            @forelse($programs as $program)
                <div class="flex justify-center">
                    <x-program-card name="{{ $program->name }}" image="{{ $program->image }}"
                        desc="{{ $program->description }}" target="{{ (int) $program->target_donation }}"
                        totalDonation="{{ $program->donations->sum('amount') }}"
                        category="{{ $program->category->name ?? 'N/A' }}" id="{{ $program->id }}"
                        createdAt="{{ $program->created_at->format('d M Y') }}" fullwidth="true"
                        status="{{$program->status}}" />
                </div>

            @empty
                <p class="text-gray-500 w-full text-center">No programs found.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $programs->links() }}
        </div>
    </main>

</main>