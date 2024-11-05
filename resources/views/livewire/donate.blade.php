@php
  $category = [
    ['id' => 1, 'name' => 'Technology'],
    ['id' => 2, 'name' => 'Health'],
    ['id' => 3, 'name' => 'Education']
  ];

  $programHere = [
    ['id' => 1, 'name' => 'Emergency Training', 'description' => 'Training program for emergency response.', 'category_id' => 2, 'disaster_id' => 3, 'created_at' => '2024-10-20T10:00:00Z', 'updated_at' => '2024-10-20T10:00:00Z'],
    ['id' => 2, 'name' => 'Coding for Kids', 'description' => 'Introductory programming for children.', 'category_id' => 1, 'disaster_id' => null, 'created_at' => '2024-10-20T11:00:00Z', 'updated_at' => '2024-10-20T11:00:00Z'],
    ['id' => 3, 'name' => 'Mental Health Awareness', 'description' => 'Promoting mental health awareness.', 'category_id' => 2, 'disaster_id' => null, 'created_at' => '2024-10-21T09:00:00Z', 'updated_at' => '2024-10-21T09:00:00Z'],
    ['id' => 4, 'name' => 'Disaster Preparedness', 'description' => 'Guidelines for disaster preparedness.', 'category_id' => 2, 'disaster_id' => 3, 'created_at' => '2024-10-22T08:30:00Z', 'updated_at' => '2024-10-22T08:30:00Z'],
    ['id' => 5, 'name' => 'Tech Literacy Workshop', 'description' => 'Technology basics for adults.', 'category_id' => 1, 'disaster_id' => null, 'created_at' => '2024-10-23T15:00:00Z', 'updated_at' => '2024-10-23T15:00:00Z'],
    ['id' => 6, 'name' => 'First Aid Training', 'description' => 'Basic first aid skills.', 'category_id' => 2, 'disaster_id' => 3, 'created_at' => '2024-10-24T10:00:00Z', 'updated_at' => '2024-10-24T10:00:00Z'],
    ['id' => 7, 'name' => 'Digital Safety', 'description' => 'Ensuring safe digital practices.', 'category_id' => 1, 'disaster_id' => null, 'created_at' => '2024-10-25T10:00:00Z', 'updated_at' => '2024-10-25T10:00:00Z'],
    ['id' => 8, 'name' => 'Nutrition for All', 'description' => 'Nutrition basics for a healthy lifestyle.', 'category_id' => 2, 'disaster_id' => null, 'created_at' => '2024-10-25T10:30:00Z', 'updated_at' => '2024-10-25T10:30:00Z'],
    ['id' => 9, 'name' => 'Climate Change Workshop', 'description' => 'Awareness on climate change impacts.', 'category_id' => 1, 'disaster_id' => null, 'created_at' => '2024-10-26T12:00:00Z', 'updated_at' => '2024-10-26T12:00:00Z'],
    ['id' => 10, 'name' => 'Youth Leadership', 'description' => 'Training youth for community leadership.', 'category_id' => 3, 'disaster_id' => null, 'created_at' => '2024-10-27T11:15:00Z', 'updated_at' => '2024-10-27T11:15:00Z'],
    ['id' => 11, 'name' => 'Financial Literacy', 'description' => 'Basic financial literacy for all ages.', 'category_id' => 3, 'disaster_id' => null, 'created_at' => '2024-10-27T14:00:00Z', 'updated_at' => '2024-10-27T14:00:00Z'],
    ['id' => 12, 'name' => 'Wellness Programs', 'description' => 'Promoting wellness activities.', 'category_id' => 2, 'disaster_id' => null, 'created_at' => '2024-10-28T09:30:00Z', 'updated_at' => '2024-10-28T09:30:00Z'],
    ['id' => 13, 'name' => 'Earthquake Safety', 'description' => 'Safety protocols during earthquakes.', 'category_id' => 2, 'disaster_id' => 3, 'created_at' => '2024-10-28T10:00:00Z', 'updated_at' => '2024-10-28T10:00:00Z'],
    ['id' => 14, 'name' => 'Digital Skills for Youth', 'description' => 'Teaching digital skills to youth.', 'category_id' => 1, 'disaster_id' => null, 'created_at' => '2024-10-29T09:45:00Z', 'updated_at' => '2024-10-29T09:45:00Z'],
    ['id' => 15, 'name' => 'Emergency Response Simulation', 'description' => 'Simulation exercises for emergency response.', 'category_id' => 2, 'disaster_id' => 3, 'created_at' => '2024-10-30T10:15:00Z', 'updated_at' => '2024-10-30T10:15:00Z'],
    ['id' => 16, 'name' => 'Safe Cooking Practices', 'description' => 'Promoting safe cooking and hygiene practices.', 'category_id' => 2, 'disaster_id' => null, 'created_at' => '2024-10-30T10:30:00Z', 'updated_at' => '2024-10-30T10:30:00Z'],
    ['id' => 17, 'name' => 'Reading Literacy Drive', 'description' => 'Encouraging reading in underprivileged areas.', 'category_id' => 3, 'disaster_id' => null, 'created_at' => '2024-10-31T09:00:00Z', 'updated_at' => '2024-10-31T09:00:00Z'],
    ['id' => 18, 'name' => 'Public Speaking Workshop', 'description' => 'Public speaking basics.', 'category_id' => 3, 'disaster_id' => null, 'created_at' => '2024-10-31T10:00:00Z', 'updated_at' => '2024-10-31T10:00:00Z'],
    ['id' => 19, 'name' => 'Water Safety', 'description' => 'Water safety tips for children.', 'category_id' => 2, 'disaster_id' => null, 'created_at' => '2024-11-01T08:00:00Z', 'updated_at' => '2024-11-01T08:00:00Z'],
    ['id' => 20, 'name' => 'Technology in Farming', 'description' => 'Using tech to enhance agriculture.', 'category_id' => 1, 'disaster_id' => null, 'created_at' => '2024-11-01T09:30:00Z', 'updated_at' => '2024-11-01T09:30:00Z']
  ];
@endphp


<main class="w-full flex bg-white-dark/10 justify-center">
  <main class="max-w-[1440px] gap-8 w-full p-4 md:p-8 lg:p-12 flex flex-col-reverse lg:grid lg:grid-cols-2">
    <!-- Left Section (Content) -->
    <section class="flex-1  flex flex-col gap-8">
      <div class="relative">
        <img src="images/placeholder.webp" class="max-h-[360px] lg:max-h-none w-full object-cover" />
        <div class="absolute top-0 left-0 z-20 bg-dark/70 flex w-full h-full p-6 md:p-12 items-end">
          <div class="flex flex-col">
            <p class="text-[24px]  md:text-[36px] text-white font-bold font-poppins">
              DONATE NOW
            </p>
            <p class="text-[12px] md:text-[18px] text-white  font-normal md:font-medium font-poppins ">
              Every donation provides life-saving aid in emergencies, school meals, nutrition support, and resilience
              programs worldwide. </p>
          </div>
        </div>
      </div>

      <section
        class="flex md:flex-row flex-col-reverse md:gap-0 gap-3 md:shadow-sm md:bg-white-light rounded-lg overflow-hidden">

        <div class=" flex flex-col">

          <div class=" bg-dark-light overflow-hidden rounded-lg md:rounded-none">
            <img src="images/Map.png" />
          </div>
          <div class="p-4 flex flex-col gap-2 ">
            <div class="flex border-b-2 justify-between w-full pb-4 ">
              <div class="flex-col flex">
                <p class="text-[20px] font-bold">Rp. 234M+</p>
                <p class="text-[14px]">Raised</p>

              </div>
              <div class="flex-col flex justify-end items-end">
                <p class="text-[20px] font-bold text-primary">+Rp. 24M</p>
                <p class="text-[14px] text-primary">in Last Year</p>
              </div>
            </div>

            <div class="flex border-b-dark/20 justify-between w-full pb-4 ">
              <div class="flex-col flex">
                <p class="text-[20px] font-bold">10.000+ </p>
                <p class="text-[14px]">Donors</p>
              </div>
              <div class="flex-col flex justify-end items-end">
                <p class="text-[20px] font-bold text-primary">+2.000+ </p>
                <p class="text-[14px] text-primary">in Last Year</p>
              </div>
            </div>
            <div class="flex border-b-2 justify-between w-full pb-4 ">
              <div class="flex-col flex">
                <p class="text-[20px] font-bold">23 Program</p>
                <p class="text-[14px]">Completed</p>
              </div>
              <div class="flex-col flex justify-end items-end">
                <p class="text-[20px] font-bold text-primary">+12 Program</p>
                <p class="text-[14px] text-primary">in Last Year</p>
              </div>
            </div>
          </div>
        </div>

        <div
          class="flex md:min-w-[280px] lg:min-w-[200px] bg-transparent md:bg-dark md:p-8 lg:p-4 gap-2 text-dark md:text-white text-center md:text-start flex-col justify-center h-full">
          <p class="text-[20px] md:text-[20px] lg:text-[16px] font-bold text-secondary md:text-white">
            Building Resilience Together
          </p>
          <p class="lg:text-[12px] ">
            Your support helps us provide critical relief, educate on disaster preparedness, and rebuild stronger
            communities worldwide. Join us in making a lasting impact.
          </p>
          <a>
            <p
              class="font-bold text-[14px] md:text-[16px] lg:text-[12px] cursor-pointer text-secondary md:text-white hover:text-secondary-dark md:hover:text-primary duration-200">
              Learn More <x-bladewind::icon class="h-3 w-3" name="chevron-right" />
            </p>
          </a>
        </div>

      </section>
      <section>

      </section>
    </section>

    <!-- Right Donate Section (Sticky) -->
    <section
      class="bg-white lg:sticky top-[80px] rounded-lg shadow-[0_0_3px_0] shadow-dark/20 p-8 flex flex-col gap-8 lg:max-w-2xl lg:max-h-fit lg:h-[calc(100vh-100px)] overflow-y-auto">
      <!-- Title Section -->
      <h1 class="text-4xl font-bold text-primary text-center">Donate</h1>

      <!-- Form Section -->
      <div class="flex flex-col gap-2">
        <!-- Personal Information Fields -->
        <p class="text-[14px] text-dark font-medium">Donor Detail</p>
        <div class="flex flex-col">
          <x-bladewind::input type="text" label="Name" name="donor_name" required
            class="bg-transparent border-dark border-[1px]" />
          <x-bladewind::input type="text" label="Email" name="donor_email" required
            class="bg-transparent border-dark border-[1px]" />
          <x-bladewind::input type="text" label="Affiliation (Optional)" name="donor_organization"
            class="bg-transparent border-dark border-[1px]" />
        </div>

        <!-- Upload Transfer Evidence Section -->
        <div class="flex flex-col gap-2">
          <p class="text-[14px] text-dark font-medium">Donation Detail</p>
          <div class="flex flex-col">
            <x-bladewind::input type="number" required label="Amount of Donation (Rp.)" name="amount"
              class="bg-transparent border-dark border-[1px]" />
            <x-bladewind::input type="file" required label="Upload" placeholder="Drop Image Here"
              name="transfer_evidence" class="bg-transparent border-dark border-[1px]" />
          </div>


          <!-- Input field to trigger program selection -->
          <div class=" rounded-md flex flex-col gap-2">
            <div class="flex gap-3 items-center">
              <div class="w-7 h-7 ">
                <x-bladewind::input type="checkbox" id="programCheckbox" onchange="togglePrograms()"
                  class="bg-transparent border-dark border-[1px]" />
              </div>
              <p class="text-[12px]">
                Allocate Donation to a Program</p>
            </div>

            <main id="programButtons" class="hidden flex flex-col gap-2 shadow-sm">
              <!-- Selected Program Wrapper -->
              <div id="selectedProgramWrapper"
                class="flex w-full  bg-white-dark p-2 items-center justify-between hidden">
                <section class="flex gap-1 flex-col">
                  <p class="text-[14px] font-bold">Selected Program:</p>
                  <p id="selectedProgramInput" class="text-[14px]"></p>
                </section>
                <div>
                  <x-button color="primary" variant="ghost" rounded="[120px]" size="square-sm"
                    onclick="clearSelectedProgram()">
                    <x-bladewind::icon name="x-mark" class="text-primary" />
                  </x-button>
                </div>
              </div>

              <div class="flex w-full flex-col gap-3 items-start" id="programList">
                <div class="flex gap-3 items-start w-full">

                  <input type="text" label="Search Program" wire:model.defer="search" placeholder="Search Program"
                    class="text-[12px] rounded-md" wire:keydown.enter="performSearch" />
                  <x-button color="dark" class="h-max" size="medium" variant="outlined" rounded="none">
                    <p class="text-[12px]">Search</p>
                  </x-button>
                  <x-button onclick="window.location='/news'" color="dark" class="h-max" size="medium"
                    variant="outlined" rounded="none">
                    <p class="text-[12px]">Clear</p>
                  </x-button>
                </div>

                <!-- Program List Container -->
                <div class="flex flex-col w-full p-2 bg-white-l">
                  @foreach ($programHere as $program)
            <div onclick="selectProgram('{{ $program['id'] }}', '{{ $program['name'] }}')"
            class="bg-transparent hover:bg-white-dark p-2 rounded-sm">
            {{ $program['id'] }} - {{ $program['name'] }}
            </div>
          @endforeach
                </div>
              </div>
            </main>
          </div>
        </div>
      </div>
      <x-button>
        Donate
      </x-button>
    </section>
  </main>
</main>

<script>
  function togglePrograms() {
    const isChecked = document.getElementById('programCheckbox').checked;
    const programButtons = document.getElementById('programButtons');
    const selectedProgramWrapper = document.getElementById('selectedProgramWrapper');
    const selectedProgramInput = document.getElementById('selectedProgramInput');

    programButtons.classList.toggle('hidden', !isChecked);

    // Reset and hide selected program if checkbox is unchecked
    if (!isChecked) {
      selectedProgramInput.innerHTML = '';
      selectedProgramWrapper.classList.add('hidden');
    }
  }

  function selectProgram(programId, programName) {
    const selectedProgramInput = document.getElementById('selectedProgramInput');
    const selectedProgramWrapper = document.getElementById('selectedProgramWrapper');
    const programList = document.getElementById('programList');

    // Set selected program details and show the wrapper
    selectedProgramInput.innerHTML = `ID: ${programId} - ${programName}`;
    selectedProgramWrapper.classList.remove('hidden');

    // Hide the program list
    programList.classList.add('hidden');
  }

  function clearSelectedProgram() {
    const selectedProgramInput = document.getElementById('selectedProgramInput');
    const selectedProgramWrapper = document.getElementById('selectedProgramWrapper');
    const programList = document.getElementById('programList');

    // Clear selected program details and hide the wrapper
    selectedProgramInput.innerHTML = '';
    selectedProgramWrapper.classList.add('hidden');

    // Show the program list
    programList.classList.remove('hidden');
  }
</script>