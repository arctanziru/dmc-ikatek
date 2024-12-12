@php
    $percentage = $program->target_donation > 0 ? ceil(($totalDonation / $program->target_donation) * 100) : 0;

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
@endphp

<main class="p-4 md:p-8 lg:p-12 flex flex-col items-center justify-center bg-white-dark/20">
    <div class="w-full flex max-w-[1440px] gap-4 md:gap-6 lg:gap-8 flex-col lg:flex-row">
        <div class="w-full flex-1 flex flex-col gap-4 h-fit">
            <!-- Program Section -->
            <section
                class="w-full flex flex-col bg-white shadow-sm shadow-dark/10 rounded-lg overflow-hidden items-center">
                <div class="w-full h-[240px] md:h-[320px] bg-secondary/30 flex overflow-hidden">
                    @if ($program->image)
                        <img src="{{ $program->image }}" alt="Program Image" class="w-full h-full object-cover" />
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500">
                            Image not available
                        </div>
                    @endif
                </div>
                <article class="w-full flex flex-col gap-2 md:gap-3 lg:gap-4 p-4 md:p-6 lg:p-8">
                    <div class="w-full flex justify-between">
                        <p class="uppercase text-[10px] md:text-[12px] lg:text-[14px] font-bold text-secondary">
                            {{ $program_category ?? 'Category Not Available' }}
                        </p>
                        <p class="uppercase text-[10px] md:text-[12px] lg:text-[14px] font-bold text-secondary">
                            {{ $program->status ?? 'Status Not Available' }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        @if ($program->target_donation > 0)
                            <!-- Progress Bar -->
                            <div class="p-[1px] w-full bg-white-dark rounded-[20px] items-center justify-start flex">
                                <div class="w-[{{ $percentage }}%] bg-secondary rounded-[20px] h-[6px]"></div>
                            </div>
                        @endif
                        <div class="flex w-full justify-between">
                            <p class="lg:text-[18px] md:text-[16px] text-[14px] font-medium">
                                Raised: Rp.{{ formatCurrency($totalDonation) }}
                            </p>
                            <p class="lg:text-[18px] md:text-[16px] text-[14px] font-medium">
                                Target:
                                {{ $program->target_donation > 0 ? 'Rp. ' . formatCurrency($program->target_donation) : 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <p class="text-[16px] md:text-[24px] lg:text-[32px] font-bold capitalize">
                        {{ $program->name ?? 'Program Name Not Available' }}
                    </p>
                    <p class="text-[10px] md:text-[12px] lg:text-[16px] font-semibold capitalize">
                        <!-- ucfirst then string to lower, to make capitalize on first letter only -->
                        {{ strtolower($program->city->province->name ?? 'Program Province Not Available') }},
                        {{ strtolower($program->city->name ?? 'Program City Not Available') }}
                    </p>
                    <p class="text-[12px] lg:text-[14px] capitalize">
                        {{ $program->description ?? 'Description Not Available' }}
                    </p>
                    <p
                        class="text-dark font-light w-full justify-end text-right text-[10px] md:text-[12px] lg:text-[14px] flex items-center gap-2">
                        <x-bladewind::icon name="calendar-days" class="!h-4 !w-4" />
                        {{ $program->created_at ? $program->created_at->format('d M Y - H:i') : 'Date Not Available' }}
                    </p>
                    @if ($program->tor_link)
                        <a class="w-full" href="{{ $program->tor_link ?? '#' }}">
                            <x-button variant="outlined" rounded="none" color="dark" class="w-full">
                                <p class="text-[12px] md:text-[14px] font-medium">
                                    View Detail
                                </p>
                            </x-button>
                        </a>
                    @endif
                </article>
            </section>

            <!-- Disaster Overview -->
            @if ($program->disaster_id && isset($disaster))
                <section class="bg-white rounded-lg shadow-sm shadow-dark/20 p-4 md:p-6 lg:p-8 flex flex-col gap-2">
                    <p class="text-[18px] font-bold">
                        Disaster Overview:
                    </p>
                    <article class="w-full flex flex-col">
                        <p class="text-[24px] capitalize font-bold text-secondary">
                            {{ $disaster->name ?? 'Disaster Name Not Available' }}
                        </p>
                        <div class="w-full flex flex-col justify-between">
                            <p
                                class="text-[12px] md:text-[14px] capitalize font-medium flex text-secondary items-center gap-2">
                                <x-bladewind::icon name="map-pin" class="!h-4 !w-4" />
                                {{ $disaster->city->name ?? 'City Not Available' }}
                            </p>
                            <p class="text-[14px] capitalize font-light flex text-secondary items-center gap-2">
                                <x-bladewind::icon name="calendar-days" class="!h-4 !w-4" />
                                {{ $disaster->created_at ? $disaster->created_at->format('d M Y - H:i') : 'Date Not Available' }}
                            </p>
                        </div>
                        <p class="text-[14px]">
                            <strong>Description:</strong><br />
                            {{ $disaster->description ?? 'Description Not Available' }}
                        </p>
                    </article>
                </section>
            @endif
        </div>

        <!-- Donation Section -->
        <main
            class=" lg:sticky top-[80px] rounded-lg shadow-[0_0_3px_0] w-full lg:w-[480px] bg-white shadow-dark/20 lg:max-w-2xl lg:max-h-fit lg:h-[calc(100vh-100px)] overflow-y-auto">
            <!-- Donation Content -->
            <div class="w-full p-2 md:p-4 lg:p-8 flex flex-col gap-8">
                <p class="text-[16px]">You Can Donate via:</p>
                <!-- Payment Options -->
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2 items-center">
                        <img src="{{ asset('images/qris.png') }}" class="h-[32px]" />
                        <img src="{{ asset('images/donate-qr.jpg') }}" class="max-w-max h-[120px] md:h-[180px]" />
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
                        <!-- Payment Buttons -->
                        <button onclick="copyToClipboard('064201002158560')"
                            class="border-secondary/20 rounded-sm border-[1px] bg-transparent hover:bg-secondary/20 cursor-pointer p-3">
                            <div class="flex gap-2 items-center">
                                <div class="w-[80px] md:w-[100px]">
                                    <img src="{{ asset('images/bri.svg') }}" class="h-[24px] w-max" />
                                </div>
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex flex-col items-start">
                                        <p class="text-[10px] md:text-[12px] font-semibold text-left">(002) No.
                                            0642.01.002158.56.0</p>
                                        <p class="text-[10px] md:text-[12px] font-semibold text-left">DMC IKATEK-UH</p>
                                    </div>
                                    <x-bladewind::icon name="clipboard" class="hidden md:flex" />
                                </div>
                            </div>
                        </button>
                        <button onclick="copyToClipboard('7709909098')"
                            class="border-secondary/20 rounded-sm border-[1px] bg-transparent hover:bg-secondary/20 cursor-pointer p-3">
                            <div class="flex gap-2 items-center">
                                <div class="w-[80px] md:w-[100px]">
                                    <img src="{{ asset('images/bsi.png') }}" class="h-[24px] w-max" />
                                </div>
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex flex-col items-start">
                                        <p class="text-[10px] md:text-[12px] font-semibold text-left">(451) No.
                                            7709-9090-98</p>
                                        <p class="text-[10px] md:text-[12px] font-semibold text-left">DMC IKATEK-UH</p>
                                    </div>
                                    <x-bladewind::icon name="clipboard" class="hidden md:flex" />
                                </div>
                            </div>
                        </button>
                    </main>
                    <p class="text-left text-[12px] text-dark/90">
                        To ensure your donation is properly accounted for, please send us your payment evidence (bukti
                        transfer) after completing the donation. This will help us verify and confirm your contribution.
                    </p>
                </div>
            </div>
            <!-- Donation Form -->
            <form wire:submit.prevent="save" id="donationForm" class="p-4 md:p-6 lg:p-8">
                <h1 class="text-[24px] md:text-[30px] lg:text-[36px] font-bold text-primary text-center">Donate</h1>
                <main class="flex flex-col gap-2">
                    <!-- Donor Details -->
                    <p class="md:text-[12px] text-[10px] lg:text-[14px] text-dark font-medium">Donor Detail</p>
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label for="donor_name"
                                class="block text-dark md:text-[12px] text-[10px] lg:text-[14px]">Donor Name</label>
                            <input type="text" id="donor_name" wire:model="donor_name"
                                class="w-full border-gray-300 rounded">
                            @error('donor_name') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="donor_email"
                                class="block text-dark md:text-[12px] text-[10px] lg:text-[14px]">Donor Email</label>
                            <input type="email" id="donor_email" wire:model="donor_email"
                                class="w-full border-gray-300 rounded">
                            @error('donor_email') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="donor_organization"
                                class="block text-dark md:text-[12px] text-[10px] lg:text-[14px]">Donor
                                Organization</label>
                            <input type="text" id="donor_organization" wire:model="donor_organization"
                                class="w-full border-gray-300 rounded">
                            @error('donor_organization') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!-- Donation Details -->
                    <section class="flex flex-col gap-2">
                        <p class="md:text-[12px] text-[10px] lg:text-[14px] text-dark font-medium">Donation Detail</p>
                        <div class="flex flex-col">
                            <div class="flex flex-col">
                                <label for="amount"
                                    class="block text-dark md:text-[12px] text-[10px] lg:text-[14px]">Amount (in
                                    IDR)</label>
                                <input type="number" id="amount" wire:model="amount"
                                    class="w-full border-gray-300 rounded" min="0" step="0.01">
                                @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex flex-col">
                                <label for="transfer_evidence"
                                    class="block text-dark md:text-[12px] text-[10px] lg:text-[14px]">Transfer
                                    Evidence</label>
                                <input type="file" id="transfer_evidence" wire:model="transfer_evidence"
                                    class="p-2 border-[1px] border-dark/40 md:text-[12px] text-[10px] lg:text-[14px] w-full rounded">
                                @error('transfer_evidence') <span class="text-red-600">{{ $message }}</span> @enderror
                                @if ($transfer_evidence)
                                    <div class="mt-2">
                                        <img src="{{ $transfer_evidence->temporaryUrl() }}" alt="Evidence Preview"
                                            class="w-32 h-32 object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                    <!-- Additional Message -->
                    <div class="flex flex-col">
                        <label for="message"
                            class="block text-dark md:text-[12px] text-[10px] lg:text-[14px]">Message</label>
                        <textarea id="message" wire:model="message" class="w-full border-gray-300 rounded"></textarea>
                        @error('message') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <x-button type="submit" wire:loading.attr="disabled" color="secondary"
                        wire:loading.class="bg-gray-400">
                        <span class="text-[12px] lg:text-[14px]" wire:loading.remove>Donate</span>
                        <span class="text-[12px] lg:text-[14px]" wire:loading>Processing...</span>
                    </x-button>
                </main>
            </form>
        </main>
    </div>
</main>