@php
    $perPageData = [
        ['label' => '5', 'value' => '5'],
        ['label' => '10', 'value' => '10'],
        ['label' => '15', 'value' => '15'],
        ['label' => '20', 'value' => '20'],
    ]
@endphp

<main class="flex flex-col gap-2 md:gap-4 lg:gap-8 max-w-[1440px] w-full items-start p-4 md:p-8 lg:p-12 mx-auto">
    <div class="flex items-center gap-4 w-full">
        <a href="{{ route('our-reach') }}" class="flex items-center gap-2">
            <!-- chevron left -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <polyline points="15 6 9 12 15 18" />
            </svg>
        </a>
        <h1 class="text-[24px] font-bold text-dark capitalize ">{{ strtolower($city->province->name) }}, <span
                class="capitalize">{{ strtolower($city->name) }}</span></h1>
    </div>

    <!-- <div>
        Deskripsi Tentang Kota Ini mencakup apa aja Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo nisi quos voluptatibus, inventore voluptatem impedit beatae debitis ad iure reprehenderit quod nemo distinctio eveniet laborum, soluta cum voluptatum placeat quasi, pariatur magnam quae! Suscipit animi, saepe amet inventore omnis pariatur cupiditate iusto, autem corrupti veniam quidem distinctio voluptates reprehenderit vel explicabo aspernatur enim numquam quos. Nemo, recusandae. Cupiditate iure incidunt ad aliquam, quas eaque velit recusandae, vero nihil rerum modi. Porro ratione inventore adipisci, esse, quia voluptate iste unde vitae dignissimos asperiores ducimus, repellat itaque tempore eos. Voluptatum aliquid rem expedita non, omnis ad tenetur harum ea! Inventore, tenetur accusantium.
    </div>

    <div>
        Gallery Disini
        <div class="flex gap-4">
            <img src="/images/management.jpeg" class="h-24"/>
            <img src="/images/management.jpeg" class="h-24"/>
            <img src="/images/management.jpeg" class="h-24"/>
            <img src="/images/management.jpeg" class="h-24"/>
        </div>
    </div> -->

    <main class="w-full flex flex-col gap-2">
        <p class="font-bold text-[20px]">
            Disaster :
        </p>
        <div class=" grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full ">
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
                                    {{$item->reporter_name ?? $item->user->name}}
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
                <p class="text-gray-500 w-screen">No disaster reported.</p>
            @endforelse
        </div>
    </main>

    <main class="flex flex-col gap-2">
        <p class="font-bold text-[20px]">
            Programs :
        </p>

        <!-- Search and Filters -->
        <div class="flex gap-4 justify-start items-center w-full">
            <!-- Search Input -->
            <input type="text" wire:model.live.debounce.500ms="programSearch" type="text" label="Search Programs"
                wire:model.defer="programSearch" placeholder="Search Programs..."
                class="text-[12px] flex-1 max-w-md rounded-md" />

            <!-- Status Filter -->
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
                <x-bladewind::tab-heading active="{{ $activeTab === 'existing' }}" name="existing" label="Existing" />
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
                            <p class="text-gray-500 w-full text-center">No programs found.</p>
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
                            <p class="text-gray-500 w-full text-center">No active programs found.</p>
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
    </main>

</main>