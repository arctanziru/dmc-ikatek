@php
  $perPageData = [
    ['value' => 5, 'label' => '5'],
    ['value' => 10, 'label' => '10'],
    ['value' => 15, 'label' => '15'],
    ['value' => 20, 'label' => '20'],
    ['value' => 50, 'label' => '50'],
  ];
@endphp

<main class="w-full flex flex-col bg-white-dark/10 justify-center items-center">
  <main class="w-full max-h-[360px] md:max-h-[640px] h-[calc(100vh-80px)] relative">
    <img src="{{ asset('storage/' . $programCategory->cover_image) }}" alt="Program Category Cover Image"
      class="w-full object-cover absolute h-full -z-19" />
    <div class="w-full justify-center h-full bg-black/70 flex z-10 absolute items-end p-4 md:p-8 lg:p-12">
      <div class="flex flex-col text-white w-full max-w-[1440px]">
        <p class="text-[24px] md:text-[36px] font-bold uppercase">{{ $programCategory->name }}</p>
        </p>
      </div>
    </div>
  </main>

  <main class=" p-4 md:p-8 lg:p-12 w-full flex flex-col gap-4 md:gap-8 lg:gap-12">
    <section class="w-full max-w-[1440px] flex-col flex gap-2 md:gap-6">

      <section class="flex flex-col ">
        <p class="text-[16px] md:text-[24px] font-poppins">Description</p>
        <div class="w-full overflow-x-auto flex md:gap-4 ">
          <p class="text-[12px] md:text-[14px]  font-poppins">
            {{ $programCategory->description }}
          </p>
        </div>
      </section>

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
            totalDonation="{{ $program->total_verified_donations ?? 0 }}"
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
            totalDonation="{{ $program->total_verified_donations ?? 0 }}"
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
            totalDonation="{{ $program->total_verified_donations ?? 0 }}"
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

      <!-- Gallery Section with Horizontal Scroll -->
      <div class="flex flex-col gap-3">
        <p class="text-[16px] md:text-[24px] font-poppins">
          Gallery
        </p>

        <!-- Horizontal Scrolling Gallery -->
        <div class="w-full overflow-x-auto flex gap-1 md:gap-4 md:py-4">
          @foreach ($programCategory->image_galleries as $imagePath)
        <div class="flex-shrink-0">
        <img src="{{ asset('storage/' . $imagePath) }}" alt="Gallery Image"
          class="w-[180px] h-[120px] md:w-[240px] md:h-[160px] object-cover rounded-lg" />
        </div>
      @endforeach
        </div>
      </div>

    </section>
  </main>
</main>