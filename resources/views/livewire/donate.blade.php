@php
  function formatCurrency($amount)
  {
    if ($amount >= 1_000_000_000_000) { // Trillion
    return number_format($amount / 1_000_000_000_000, 3) . ' T+'; // Format to 3 decimal places and add +
    } elseif ($amount >= 1_000_000_000) { // Billion
    return number_format($amount / 1_000_000_000, 3) . ' B+'; // Format to 3 decimal places and add +
    } elseif ($amount >= 1_000_000) { // Million
    return number_format($amount / 1_000_000, 2) . ' M'; // Format to 2 decimal places
    } else {
    return number_format($amount, 2); // Default formatting
    }
  }

  $donationText = [
    'en' => 'To ensure your donation is properly accounted for, please send us your payment evidence (bukti transfer) after completing the donation. This will help us verify and confirm your contribution.',
    'idn' => 'Untuk memastikan donasi Anda tercatat dengan baik, harap kirimkan bukti pembayaran (bukti transfer) setelah melakukan donasi. Hal ini akan membantu kami untuk memverifikasi dan mengonfirmasi kontribusi Anda.'
  ];

  $currentLanguage = 'en'
@endphp

<main class="w-full flex bg-white-dark/10 justify-center">
  <main class="max-w-[1440px] gap-8 w-full p-4 md:p-8 lg:p-12 flex flex-col-reverse lg:grid lg:grid-cols-2">
    <!-- Left Section (Content) -->
    <section class="flex-1  flex flex-col gap-8">
      <div class="relative">
        <img src="images/donate.jpg" class="max-h-[360px] lg:max-h-none w-full object-cover" />
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
                <p class="text-[20px] font-bold">Rp. {{(formatCurrency($totalDonations))}}</p>
                <p class="text-[14px]">Raised</p>

              </div>
              <div class="flex-col flex justify-end items-end">
                <p class="text-[20px] font-bold text-primary">+Rp. {{formatCurrency($totalDonationsThisYear)}}</p>
                <p class="text-[14px] text-primary">in Last Year</p>
              </div>
            </div>

            <div class="flex border-b-dark/20 justify-between w-full pb-4 ">
              <div class="flex-col flex">
                <p class="text-[20px] font-bold">{{$donorCount}} </p>
                <p class="text-[14px]">Donors (per email)</p>
              </div>
              <div class="flex-col flex justify-end items-end">
                <p class="text-[20px] font-bold text-primary">+{{$donorCountThisYear}} </p>
                <p class="text-[14px] text-primary">in Last Year</p>
              </div>
            </div>
            <div class="flex border-b-2 justify-between w-full pb-4 ">
              <div class="flex-col flex">
                <p class="text-[20px] font-bold">{{$programCount}} Program</p>
                <p class="text-[14px]">Made</p>
              </div>
              <div class="flex-col flex justify-end items-end">
                <p class="text-[20px] font-bold text-primary">+{{$programCountThisYear}} Program</p>
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
            <a href="/our-works"
              class="font-bold text-[14px] md:text-[16px] lg:text-[12px] cursor-pointer text-secondary md:text-white hover:text-secondary-dark md:hover:text-primary duration-200">
              Learn More <x-bladewind::icon class="h-3 w-3" name="chevron-right" />
            </a>
          </a>
        </div>

      </section>
      <section>

      </section>
    </section>

    <!-- Right Donate Section (Sticky) -->

    <div
      class="bg-white lg:sticky top-[80px] rounded-lg shadow-[0_0_3px_0] shadow-dark/20 lg:max-w-2xl lg:max-h-fit lg:h-[calc(100vh-100px)] overflow-y-auto">
      <div class="w-full p-2 md:p-4 lg:p-8 flex flex-col gap-8">
        <p class="text-[16px]">
          You Can Donate via :
        </p>
        <div class="flex flex-col gap-4">

          <div class="flex flex-col gap-2 items-center">
            <img src="images/qris.png" class="h-[32px]" />
            <img src="images/donate-qr.jpg" class="max-w-max h-[120px] md:h-[180px]" />
            <p class="text-[18px] md:text-[24px] font-bold text-center">
              TOKO DMC IKATEK UH
            </p>
          </div>
          <div class="flex gap-1 items-center">
            <div class="h-[1px] flex-1 bg-dark/20"></div>
            <p class="text-[14px] text-dark/40">or</p>
            <div class="h-[1px] flex-1 bg-dark/20"></div>
          </div>
          <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
            <button onclick="copyToClipboard('064201002158560')"
              class="border-secondary/20 rounded-sm border-[1px] bg-transparent hover:bg-secondary/20 cursor-pointer p-3">
              <div class="flex gap-2 items-center">
                <div class="w-[80px]  md:w-[100px]">
                  <img src="images/bri.svg" class="h-[24px] w-max" />
                </div>
                <div class="w-full flex items-center justify-between">
                  <div class="flex flex-col items-start">
                    <p class="text-[10px] md:text-[12px] font-semibold text-left">(002) No. 0642.01.002158.56.0
                    </p>
                    <p class="text-[10px] md:text-[12px] font-semibold text-left">DMC IKATEK-UH</p>
                  </div>
                  <x-bladewind::icon name="clipboard" class="hidden md:flex" />
                </div>

              </div>
            </button>
            <button onclick="copyToClipboard('7709909098')"
              class="border-secondary/20 rounded-sm border-[1px] bg-transparent hover:bg-secondary/20 cursor-pointer p-3">
              <div class="flex gap-2 items-center">
                <div class="w-[80px]  md:w-[100px]">
                  <img src="images/bsi.png" class="h-[24px] w-max" />
                </div>
                <div class="w-full flex items-center justify-between">
                  <div class="flex flex-col items-start">
                    <p class="text-[10px] md:text-[12px] font-semibold text-left">(451) No. 7709-9090-98
                    </p>
                    <p class="text-[10px] md:text-[12px] font-semibold text-left">DMC IKATEK-UH</p>
                  </div>
                  <x-bladewind::icon name="clipboard" class="hidden md:flex" />
                </div>

              </div>
            </button>
          </main>
          <p class="text-left text-[12px] text-dark/90">
            <?= htmlspecialchars($donationText[$currentLanguage]); ?>
          </p>
        </div>

      </div>
      <form wire:submit.prevent="save" id="donationForm" class="p-8 ">
        <h1 class="text-4xl font-bold p-8 text-primary text-center  flex flex-col gap-8">Donate</h1>

        <!-- Form Section -->
        <div class="flex flex-col gap-2">
          <!-- Personal Information Fields -->
          <p class="text-[14px] text-dark font-medium">Donor Detail</p>
          <div class="flex flex-col">
            @error('donor_name') <span class="text-red-600">{{ $message }}</span> @enderror
            <x-bladewind::input type="text" label="Name" name="donor_name" wire:model="donor_name" required
              class="bg-transparent border-dark border-[1px]" />

            @error('donor_email') <span class="text-red-600">{{ $message }}</span> @enderror
            <x-bladewind::input type="text" label="Email" name="donor_email" wire:model="donor_email" required
              class="bg-transparent border-dark border-[1px]" />

            @error('donor_organization') <span class="text-red-600">{{ $message }}</span> @enderror
            <x-bladewind::input type="text" label="Affiliation (Optional)" name="donor_organization"
              wire:model="donor_organization" class="bg-transparent border-dark border-[1px]" />

          </div>







          <!-- Upload Transfer Evidence Section -->
          <div class="flex flex-col gap-2">
            <p class="text-[14px] text-dark font-medium">Donation Detail</p>
            <div class="flex flex-col">
              @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror
              <x-bladewind::input type="number" required label="Amount of Donation (Rp.)" name="amount"
                wire:model="amount" class="bg-transparent border-dark border-[1px]" />

              @error('transfer_evidence') <span class="text-red-600">{{ $message }}</span> @enderror
              <x-bladewind::input type="file" required label="Upload" placeholder="Drop Image Here"
                name="transfer_evidence" class="bg-transparent border-dark border-[1px]"
                wire:model="transfer_evidence" />

            </div>


            <!-- Input field to trigger program selection -->
            <div class="flex flex-col gap-2">
              @error('disaster_program_id') <span class="text-red-600">{{ $message }}</span> @enderror
              <label for="disaster_program_id" class="text-[14px] font-medium text-gray-700">Disaster
                Program</label>
              <select id="disaster_program_id" wire:model="disaster_program_id"
                class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Program</option>
                @foreach ($programs as $program)
          <option value="{{ $program->id }}">{{ $program->name }}</option>
        @endforeach
              </select>
              @error('message') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
          </div>

          <x-button type="submit">
            Donate
          </x-button>
        </div>
      </form>
    </div>




    <!-- Title Section -->

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

<script>
  function copyToClipboard(text) {
    // Create a dummy input element to hold the text
    const input = document.createElement('input');
    input.value = text;
    document.body.appendChild(input);

    // Select the text inside the input
    input.select();
    input.setSelectionRange(0, 99999); // For mobile devices

    // Execute the copy command
    document.execCommand('copy');

    // Remove the dummy input element
    document.body.removeChild(input);

    // Optionally, you can display a success message or change the icon
    alert("Bank account number copied to clipboard!");
  }
</script>