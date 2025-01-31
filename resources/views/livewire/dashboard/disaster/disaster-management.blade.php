@php
$perPageData = [
['label' => '5', 'value' => '5'],
['label' => '10', 'value' => '10'],
['label' => '15', 'value' => '15'],
['label' => '20', 'value' => '20'],
];

$statusOptions = [
'pending' => 'Pending',
'active' => 'Active',
'inactive' => 'Inactive',
'rejected' => 'Rejected',
];
@endphp

<main class="p-6 space-y-4">
    <h2 class="text-2xl font-semibold mb-4">Disaster Management</h2>

    <div class="flex items-center space-x-4">
        <x-bladewind::input type="text" wire:model.live.debounce.500ms="search" placeholder="Search disasters..."
            class="border h-full" />

        <select wire:model.live.debounce.150ms="perPage" class="border rounded-md bw-raw-select w-20 mb-4">
            @foreach($perPageData as $data)
            <option value="{{ $data['value'] }}">{{ $data['label'] }}</option>
            @endforeach
        </select>
        <x-button wire:click="redirectToCreate" class="shrink-0 mb-4">Create Disaster</x-button>
    </div>

    <div class="overflow-x-auto">

        <x-bladewind::table has_shadow="true" divider="thin">
            <x-slot name="header" class="bg-gray-50">
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>City</th>
                <th>Reporter</th>
                <th>Status</th>
                <th>Time of Disaster</th>
                <th>Actions</th>
            </x-slot>
            <tbody>
                @foreach ($disasters as $disaster)
                <tr>
                    <td>{{ $disaster->name }}</td>
                    <td>{{ $disaster->latitude }}</td>
                    <td>{{ $disaster->longitude }}</td>
                    <td>{{ $disaster->city->name }}</td>
                    <td>{{ $disaster->reporter_name ?? $disaster->user->name  ?? 'Anonym' }}</td>
                    <td class="w-[120px] whitespace-nowrap">
                        <select wire:change="updateStatus({{ $disaster->id }}, $event.target.value)"
                            class="border rounded-md w-full p-1">
                            @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" @if($disaster->status === $value) selected @endif>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="whitespace-nowrap">
                        {{ $disaster->time_of_disaster }}
                    </td>
                    <td class="shrink-0">
                        <x-bladewind::button wire:click="redirectToEdit({{ $disaster->id }})" size="small"
                            color="primary" icon="pencil-square">
                            Edit
                        </x-bladewind::button>
                        <x-bladewind::button wire:click="deleteDisaster({{ $disaster->id }})"
                            wire:confirm="Are you sure to delete this?" size="small" color="red" icon="trash">
                            Delete
                        </x-bladewind::button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-bladewind::table>
    </div>

    <!-- Pagination links -->
    {{ $disasters->links() }}
</main>