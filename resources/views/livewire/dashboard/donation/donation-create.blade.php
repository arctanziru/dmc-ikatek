<main class="p-4">
    <form wire:submit.prevent="save" id="donationForm">
        <div class="mb-4">
            <label for="donor_name" class="block text-gray-700">Donor Name</label>
            <input type="text" id="donor_name" wire:model="donor_name" class="w-full border-gray-300 rounded">
            @error('donor_name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="donor_organization" class="block text-gray-700">Donor Organization</label>
            <input type="text" id="donor_organization" wire:model="donor_organization" class="w-full border-gray-300 rounded">
            @error('donor_organization') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="donor_email" class="block text-gray-700">Donor Email</label>
            <input type="email" id="donor_email" wire:model="donor_email" class="w-full border-gray-300 rounded">
            @error('donor_email') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-gray-700">Amount (in IDR)</label>
            <input type="number" id="amount" wire:model="amount" class="w-full border-gray-300 rounded" min="0" step="0.01">
            @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="message" class="block text-gray-700">Message</label>
            <textarea id="message" wire:model="message" class="w-full border-gray-300 rounded"></textarea>
            @error('message') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="transfer_evidence" class="block text-gray-700">Transfer Evidence</label>
            <input type="file" id="transfer_evidence" wire:model="transfer_evidence" class="w-fit border-gray-300 rounded">
            @error('transfer_evidence') <span class="text-red-600">{{ $message }}</span> @enderror

            @if ($transfer_evidence)
            <div class="mt-2">
                <img src="{{ $transfer_evidence->temporaryUrl() }}" alt="Evidence Preview" class="w-32 h-32 object-cover">
            </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="donation_date" class="block text-gray-700">Donation Date</label>
            <input type="date" id="donation_date" wire:model="donation_date" class="w-full border-gray-300 rounded">
            @error('donation_date') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="disaster_program_id" class="block text-gray-700">Disaster Program</label>
            <select id="disaster_program_id" wire:model="disaster_program_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Program</option>
                @foreach ($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
            @error('disaster_program_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Donation</button>
    </form>
</main>