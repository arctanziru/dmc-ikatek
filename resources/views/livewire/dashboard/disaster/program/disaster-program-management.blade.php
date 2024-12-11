@php
$perPageData = [
['label' => '5', 'value' => '5'],
['label' => '10', 'value' => '10'],
['label' => '15', 'value' => '15'],
['label' => '20', 'value' => '20'],
];

$statusOptions = [
'active' => 'Active',
'inactive' => 'Inactive',
];
@endphp

<div class="p-6 space-y-4">
    <h2 class="text-2xl font-semibold mb-4">Disaster Program Management</h2>

    <div class="flex items-center space-x-4">
        <x-bladewind::input
            type="text"
            wire:model.live.debounce.500ms="search"
            placeholder="Search programs..."
            class="border h-full" />

        <select wire:model.live.debounce.150ms="perPage" class="border rounded-md bw-raw-select w-20 mb-4">
            @foreach($perPageData as $data)
            <option value="{{ $data['value'] }}">{{ $data['label'] }}</option>
            @endforeach
        </select>
        <select wire:model.live.debounce.150ms="status" class="border rounded-md bw-raw-select w-24 mb-4">
            <option value="">All</option>
            @foreach($statusOptions as $value => $label)
            <option value="{{ $value }}" @if($status===$value) selected @endif>
                {{ $label }}
            </option>
            @endforeach
        </select>
        <x-button wire:click="redirectToCreate" class="shrink-0 mb-4">Create Program</x-button>
    </div>

    <div class=overflow-x-auto"">
        <x-bladewind::table has_shadow="true" divider="thin">
            <x-slot name="header" class="bg-gray-50">
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Category</th>
                <th>Disaster</th>
                <th>City</th>
                <th>Status</th>
                <th>Total Donations</th>
                <th>Target Donations</th>
                <th>Actions</th>
            </x-slot>
            <tbody>
                @foreach ($programs as $program)
                <tr>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->description }}</td>
                    <td>
                        <img src="{{ $program->image }}" alt="{{ $program->name }}" class="w-[100px] h-[100px] object-cover">
                    </td>
                    <td>{{ $program->category->name ?? 'N/A' }}</td>
                    <td>{{ $program->disaster->name ?? 'N/A' }}</td>
                    <td>{{ $program->city->name ?? 'N/A' }}</td>
                    <td class="w-[120px]">
                        <select wire:change="updateStatus({{ $program->id }}, $event.target.value)" class="border rounded-md w-full p-1">
                            @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" @if($program->status === $value) selected @endif>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>Rp{{ number_format($program->donations->sum('amount'), 0, ',', '.') }}</td>
                    <td>{{ $program->target_donation ? 'Rp'.number_format($program->target_donation, 0, ',', '.') : 'N/A' }}</td>
                    <td class="shrink-0">
                        <x-bladewind::button wire:click="redirectToEdit({{ $program->id }})" size="small" color="primary" icon="pencil-square">
                            Edit
                        </x-bladewind::button>
                        <x-bladewind::button wire:click="deleteProgram({{ $program->id }})" wire:confirm="Are you sure to delete this?" size="small" color="red" icon="trash">
                            Delete
                        </x-bladewind::button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-bladewind::table>

        <!-- Pagination links -->
        {{ $programs->links() }}
    </div>