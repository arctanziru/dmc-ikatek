@php
  $history = [
    '2016' => [
    [
      'month' => 'November',
      'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget lorem nec velit facilisis aliquet.'
    ],
    [
      'month' => 'December',
      'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.'
    ]
    ],
    '2017' => [
    [
      'month' => 'January',
      'text' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    ],
    [
      'month' => 'February',
      'text' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
    ],
    [
      'month' => 'March',
      'text' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    ]
    ],
    '2018' => [
    [
      'month' => 'April',
      'text' => 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.'
    ],
    [
      'month' => 'May',
      'text' => 'Integer malesuada nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis.'
    ]
    ]
  ];

@endphp

<main class="flex flex-col  gap-4 md:gap-8 lg:gap-12">
  <section class="w-full bg-white-dark/40 p-4 md:p-8 lg:p-12 flex ">
    <div class="relative max-w-[1440px] flex flex-col md:flex-row w-full justify-between gap-3 md:gap-6">
      <p class="text-[48px] font-bold text-secondary">History</p>
      <div class="relative w-full md:w-[420px]">
        <div class="static md:absolute right-0">
          <img src="images/history.JPG" class=" object-cover h-[180px] w-full md:h-[250px]" />
          <div class="absolute top-0 right-0 w-full h-full bg-black/50"></div>
        </div>
      </div>
    </div>
  </section>
  <main class="w-full max-w-[1440px] flex-col flex p-4 md:p-8 lg:p-12 gap-4 md:gap-4 lg:gap-8">
    <div class="flex flex-col gap-6">
      <div>
        <p class="text-[24px] md:text-[28px] text-secondary font-bold">2016</p>
        <p class="text-[16px] md:text-[16px] md:max-w-[50%] font-semibold">Lorem ipsum dolor sit, amet consectetur
          adipisicing elit. Nostrum, obcaecati!</p>
      </div>
      <div>
        <p class="text-[24px] md:text-[28px] text-secondary font-bold">2020</p>
        <p class="text-[16px] md:text-[16px] md:max-w-[50%] font-semibold">Lorem ipsum dolor sit, amet consectetur
          adipisicing elit. Nostrum, obcaecati!</p>
      </div>
      <div>
        <p class="text-[24px] md:text-[28px] text-secondary font-bold">2023</p>
        <p class="text-[16px] md:text-[16px] md:max-w-[50%] font-semibold">Lorem ipsum dolor sit, amet consectetur
          adipisicing elit. Nostrum, obcaecati!</p>
      </div>
    </div>


    <section class="flex flex-col w-full border-b gap-4 border-gray-300">
      <!-- Static Header for Area of Works -->
      <div class="flex flex-col">
        <div class="flex w-full justify-between">
          <p class="text-[32px] font-bold">Explore History</p>
        </div>
      </div>

      <!-- Main Content -->
      <main class="flex flex-col">
        <section class="flex flex-col gap-2">
          @foreach ($history as $year => $months)
        <!-- Year Accordion Header -->
        <div class="flex flex-col">
        <div
          class="bg-white-dark/40 p-4 hover:border-l-8 border-primary duration-200 flex justify-between items-center w-full cursor-pointer"
          onclick="toggleAccordion('year-{{ $year }}')">
          <p class="text-[20px] font-bold">{{ $year }}</p>
          <p class="transition-transform transform rotate-0" id="year-{{ $year }}-icon">▼</p>

        </div>

        <!-- Year Accordion Content (Initially Hidden) -->
        <div id="year-{{ $year }}"
          class="accordion-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out pl-4 bg-white-dark/40">
          @foreach ($months as $month)
        <div class="flex flex-col gap-1">
        <p class="text-[16px] font-medium">{{ $month['month'] }}</p>
        <p class="text-[14px] font-light">{{ $month['text'] }}</p>
        </div>
      @endforeach
        </div>
        </div>
      @endforeach
        </section>
      </main>
    </section>


  </main>
</main>



<script>
  function toggleAccordion(id) {
    const content = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');

    // Toggle max-height and rotate icon
    if (content.classList.contains('max-h-0')) {
      content.classList.remove('max-h-0');
      content.classList.add('max-h-screen');
      icon.classList.add('rotate-180');
    } else {
      content.classList.add('max-h-0');
      content.classList.remove('max-h-screen');
      icon.classList.remove('rotate-180');
    }
  }
</script>