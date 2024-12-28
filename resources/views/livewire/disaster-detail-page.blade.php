@php
  $perPageData = [
    ['label' => '5', 'value' => '5'],
    ['label' => '10', 'value' => '10'],
    ['label' => '15', 'value' => '15'],
    ['label' => '20', 'value' => '20'],
  ];
@endphp

<main class="w-full flex flex-col items-center p-4 md:p-8 lg:p-12 bg-white-dark/10 justify-center">
  <main class="max-w-[1440px] flex flex-col gap-4 md:gap-8 lg:gap-12 w-full">
    <section class="w-full flex flex-col lg:flex-row gap-4 md:gap-8">

      <img src="{{ asset('storage/' . $disaster->image) }}" loading="lazy"
        class="md:h-[340px] lg:h-[300px] rounded-md w-full lg:w-[360px] object-cover"
        onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';" />
      <div class="flex flex-col gap-2">
        <p class="font-bold text-[24px] md:text-[32px] text-dark ">
          {{$disaster->name}}
        </p>
        <p class="text-[14px] md:text-[16px] uppercase font-bold text-primary">
          {{$disaster->status}}
        </p>
        <div class="flex flex-col">

          <div class="flex gap-2 items-center">
            <x-bladewind::icon name="map-pin" class="!h-4 !w-4" />
            <p class="text-[12px] md:text-[14px] capitalize font-normal text-dark ">
              {{ ucwords(strtolower($disaster->city->name)) }},

              {{ ucwords(strtolower($disaster->city->province->name)) }}
            </p>
          </div>
          <div class="flex gap-2 items-center">
            <x-bladewind::icon name="user" class="!h-4 !w-4" />
            <p class="text-[12px] md:text-[14px] capitalize font-normal text-dark ">
              {{ $disaster->reporter_name ? ($disaster->reporter_name) : 'N/A' }}
            </p>
          </div>
          <div class="flex gap-2 items-center">
            <x-bladewind::icon name="calendar-days" class="!h-4 !w-4" />
            <p class="text-[12px] md:text-[14px] capitalize font-normal text-dark ">
              {{ $disaster->time_of_disaster ? (new DateTime($disaster->time_of_disaster))->format('d M Y') : 'N/A' }}
            </p>
          </div>
        </div>

        <p class="text-[12px] md:text-[16px] font-normal">
          {{$disaster->description}}
        </p>
      </div>
    </section>
    <section class="flex flex-col gap-3">
      <p class="text-[16px] md:text-[24px] font-poppins">Gallery</p>
      <div class="w-full overflow-x-auto flex gap-1 md:gap-4 md:py-4">
        @foreach (json_decode($disaster->image_galleries, true) ?? [] as $imagePath)
      <div class="flex-shrink-0">
        <img src="{{ asset('storage/' . $imagePath) }}" alt="Gallery Image"
        class="w-[180px] h-[120px] md:w-[240px] shadow-sm shadow-dark md:h-[160px] object-cover rounded-lg" />
      </div>
    @endforeach
      </div>
    </section>
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
            totalDonation="{{ $program->total_verified_donations ?? 0  }}"
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