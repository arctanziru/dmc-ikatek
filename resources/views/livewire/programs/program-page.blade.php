@php
    $perPageData = [
        ['label' => '5', 'value' => '5'],
        ['label' => '10', 'value' => '10'],
        ['label' => '15', 'value' => '15'],
        ['label' => '20', 'value' => '20'],
    ]
@endphp

<main class="w-full flex flex-col bg-white-dark/10 justify-center items-center">
    <main class=" p-4 md:p-8 lg:p-12 w-full flex flex-col gap-4 md:gap-8 lg:gap-12">
        <section class="w-full max-w-[1440px] flex-col flex gap-2 md:gap-6">

            <p class="text-[16px] md:text-[24px] font-poppins">
                Programs
            </p>

            <!-- Search and Filters -->
            <div class="flex gap-4 w-full">
                <!-- Search Input -->
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search Disaster..."
                    class="text-[12px] flex-1 max-w-md rounded-md" wire:keydown.enter="performSearch" />

                <!-- Per Page Select -->
                <div class="flex min-w-[60px]">
                    <select wire:model.live.debounce.150ms="perPage" class="border rounded p-2 w-full text-[12px]">
                        @foreach($perPageData as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <!-- Program Cards -->
            <x-bladewind::tab-group name="programs" color="orange">
                <x-slot:headings>
                    <x-bladewind::tab-heading active="{{ $activeTab === 'existing' }}" name="existing"
                        label="Existing" />
                    <x-bladewind::tab-heading active="{{ $activeTab === 'active' }}" name="active" label="Active" />
                    <x-bladewind::tab-heading active="{{ $activeTab === 'done' }}" name="done" label="Done" />
                </x-slot:headings>

                <x-bladewind::tab-body>
                    <!-- Active Tab -->
                    <x-bladewind::tab-content name="existing" active="{{ $activeTab === 'existing' }}">
                        <div
                            class="grid grid-cols-1 w-full justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 lg:gap-4">
                            @forelse($programs as $program)
                                <div class="flex justify-center">
                                    <x-program-card name="{{ $program->name }}" image="{{ $program->image }}"
                                        desc="{{ $program->description }}" target="{{ (int) $program->target_donation }}"
                                        totalDonation="{{ $program->donations->sum('amount') }}"
                                        category="{{ $program->category->name ?? 'N/A' }}" id="{{ $program->id }}"
                                        createdAt="{{ $program->created_at->format('d M Y') }}" fullwidth="true"
                                        status="{{ $program->status }}"
                                        location="{{$program->city->name ?? 'N/A'}}, {{$program->city->province->name ?? 'N/A'}}" />
                                </div>
                            @empty
                                <p class="text-gray-500 w-full text-center">No active programs found.</p>
                            @endforelse
                        </div>
                    </x-bladewind::tab-content>

                    <!-- Inactive Tab -->
                    <x-bladewind::tab-content name="active" active="{{ $activeTab === 'active' }}">
                        <div
                            class="grid grid-cols-1 w-full justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 lg:gap-4">
                            @forelse($programs->where('status', 'active') as $program)
                                <div class="flex justify-center">
                                    <x-program-card name="{{ $program->name }}" image="{{ $program->image }}"
                                        desc="{{ $program->description }}" target="{{ (int) $program->target_donation }}"
                                        totalDonation="{{ $program->donations->sum('amount') }}"
                                        category="{{ $program->category->name ?? 'N/A' }}" id="{{ $program->id }}"
                                        createdAt="{{ $program->created_at->format('d M Y') }}" fullwidth="true"
                                        status="{{ $program->status }}"
                                        location="{{$program->city->name ?? 'N/A'}}, {{$program->city->province->name ?? 'N/A'}}" />
                                </div>
                            @empty
                                <p class="text-gray-500 w-full text-center">No inactive programs found.</p>
                            @endforelse
                        </div>
                    </x-bladewind::tab-content>

                    <!-- Done Tab -->
                    <x-bladewind::tab-content name="done" active="{{ $activeTab === 'done' }}">
                        <div
                            class="grid grid-cols-1 w-full justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 lg:gap-4">
                            @forelse($programs->where('status', 'inactive') as $program)
                                <div class="flex justify-center">
                                    <x-program-card name="{{ $program->name }}" image="{{ $program->image }}"
                                        desc="{{ $program->description }}" target="{{ (int) $program->target_donation }}"
                                        totalDonation="{{ $program->donations->sum('amount') }}"
                                        category="{{ $program->category->name ?? 'N/A' }}" id="{{ $program->id }}"
                                        createdAt="{{ $program->created_at->format('d M Y') }}" fullwidth="true"
                                        status="{{ $program->status }}"
                                        location="{{$program->city->name ?? 'N/A'}}, {{$program->city->province->name ?? 'N/A'}}" />
                                </div>
                            @empty
                                <p class="text-gray-500 w-full text-center">No inactive programs found.</p>
                            @endforelse
                        </div>
                    </x-bladewind::tab-content>
                </x-bladewind::tab-body>
            </x-bladewind::tab-group>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $programs->links() }}
            </div>
        </section>
    </main>
</main>