@php
    $perPageData = [
        ['label' => '5', 'value' => '5'],
        ['label' => '10', 'value' => '10'],
        ['label' => '15', 'value' => '15'],
        ['label' => '20', 'value' => '20'],
    ];
@endphp

<main class="w-full flex flex-col items-center bg-white-dark/10 justify-center">
    <!-- Covered Area Detail -->
    <x-cover-image src="{{ asset('storage/' . $coveredArea->image) }}" alt="Cover Image">
        <p class="text-[24px] md:text-[36px] font-bold uppercase drop-shadow-[0_10px_1000px_rgba(0,0,0,0.25)]">
            {{ strtolower($coveredArea->city->province->name) }}, {{ strtolower($coveredArea->city->name) }}
        </p>
    </x-cover-image>

    <!-- Content Section -->

    <section class="w-full p-4 md:p-8 lg:p-12 flex  items-center justify-center">
        <div class="w-full max-w-[1440px] flex  flex-col gap-4 md:gap-8 lg:gap-12">

            <section class="flex flex-col ">
                <p class="text-[16px] md:text-[24px] font-poppins">Description</p>
                <div class="w-full overflow-x-auto flex md:gap-4 ">
                    <p class="text-[12px] md:text-[14px]  font-poppins">
                        {{ $coveredArea->description }}
                    </p>
                </div>
            </section>
            <!-- Gallery Section -->
            <section class="flex flex-col gap-3">
                <p class="text-[16px] md:text-[24px] font-poppins">Gallery</p>
                <div class="w-full overflow-x-auto flex gap-1 md:gap-4 ">
                    @foreach (json_decode($coveredArea->image_galleries, true) ?? [] as $imagePath)
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Gallery Image"
                                class="w-[180px] h-[120px] md:w-[240px] shadow-sm shadow-dark md:h-[160px] object-cover rounded-lg" />
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Disaster Section -->
            <section class="w-full flex flex-col gap-2">
                <p class="text-[16px] md:text-[24px] font-poppins">Disaster</p>
                <div class="flex gap-4 justify-start items-center w-full">
                    <input type="text" wire:model.live.debounce.500ms="disasterSearch" placeholder="Search Disaster..."
                        class="text-[12px] flex-1 max-w-md rounded-md" />
                    <select wire:model.live.debounce.150ms="disasterPerPage"
                        class="border rounded p-2 w-[60px] text-[12px]">
                        @foreach($perPageData as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
                    @forelse ($disasters as $disaster)
                        <x-disaster-card :disaster="$disaster" />
                    @empty
                        <p class="text-gray-500 w-full text-center">No disasters found.</p>
                    @endforelse
                </div>
                <div class="mt-6" wire:loading.class="opacity-50">
                    {{ $disasters->links() }}
                </div>
            </section>

            <!-- Program Section -->
            <section class="flex flex-col gap-2">
                <p class="text-[16px] md:text-[24px] font-poppins">Programs</p>
                <div class="flex gap-4 justify-start items-center w-full">
                    <input type="text" wire:model.live.debounce.500ms="programSearch" placeholder="Search Programs..."
                        class="text-[12px] flex-1 max-w-md rounded-md" />
                    <select wire:model.live.debounce.150ms="programPerPage"
                        class="border rounded p-2 w-[60px] text-[12px]">
                        @foreach($perPageData as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
                    @forelse ($programs as $program)
                        <x-program-card name="{{ $program->name }}" image="{{ $program->image }}"
                            desc="{{ $program->description }}" target="{{ (int) $program->target_donation }}"
                            totalDonation="{{ $program->total_verified_donations ?? 0 }}"
                            category="{{ $program->category->name ?? 'N/A' }}" id="{{ $program->id }}"
                            createdAt="{{ $program->created_at->format('d M Y') }}" fullwidth="true"
                            status="{{ $program->status }}"
                            location="{{ $program->city->name ?? 'N/A' }}, {{ $program->city->province->name ?? 'N/A' }}" />
                    @empty
                        <p class="text-gray-500 w-full text-center">No programs found.</p>
                    @endforelse
                </div>
                <div class="mt-6">
                    {{ $programs->links() }}
                </div>
            </section>

        </div>
    </section>
</main>