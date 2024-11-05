@php
$perPageData = [
['label' => '5', 'value' => '5'],
['label' => '10', 'value' => '10'],
['label' => '15', 'value' => '15'],
['label' => '20', 'value' => '20'],
];

$statusOptions = [
'pending' => 'Pending',
'verified' => 'Verified',
'rejected' => 'Rejected',
];
@endphp

<div class="p-6 space-y-4">
    <h2 class="text-2xl font-semibold mb-4">Donation Management</h2>

    <div class="flex items-center space-x-4">
        <x-bladewind::input
            type="text"
            wire:model.live.debounce.500ms="search"
            placeholder="Search donations..."
            class="border h-full" />

        <select wire:model.live.debounce.150ms="perPage" class="border rounded-md bw-raw-select w-20 mb-4">
            @foreach($perPageData as $data)
            <option value="{{ $data['value'] }}">{{ $data['label'] }}</option>
            @endforeach
        </select>

        <x-button wire:click="redirectToCreate" class="shrink-0 mb-4">Add Donation</x-button>
    </div>

    <x-bladewind::table has_shadow="true" divider="thin">
        <x-slot name="header" class="bg-gray-50">
            <th>Donor Name</th>
            <th>Organization</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Program</th>
            <th>Donation Date</th>
            <th>Status</th>
            <th>Actions</th>
        </x-slot>
        <tbody>
            @foreach ($donations as $donation)
            <tr>
                <td>{{ $donation->donor_name }}</td>
                <td>{{ $donation->donor_organization ?? 'N/A' }}</td>
                <td>{{ $donation->donor_email }}</td>
                <td>Rp{{ number_format($donation->amount, 0, ',', '.') }}</td>
                <td>{{ $donation->disasterProgram->name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($donation->donation_date)->format('d M Y') }}</td>
                <td>
                    <select wire:change="updateDonationStatus({{ $donation->id }}, $event.target.value)" class="border rounded-md w-full p-1">
                        @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" @if($donation->status === $value) selected @endif>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td class="shrink-0">
                    <x-bladewind::button wire:click="redirectToEdit({{ $donation->id }})" size="small" color="primary" icon="pencil-square">
                        Edit
                    </x-bladewind::button>
                    <x-bladewind::button wire:click="deleteDonation({{ $donation->id }})" wire:confirm="Are you sure to delete this?" size="small" color="red" icon="trash">
                        Delete
                    </x-bladewind::button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </x-bladewind::table>

    <!-- Pagination links -->
    {{ $donations->links() }}
</div>