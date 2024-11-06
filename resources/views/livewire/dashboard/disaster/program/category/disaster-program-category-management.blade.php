@php
    $perPageData = [
        ['label' => '5', 'value' => '5'],
        ['label' => '10', 'value' => '10'],
        ['label' => '15', 'value' => '15'],
        ['label' => '20', 'value' => '20'],
    ];
@endphp

<div class="p-6 space-y-4">
    <h2 class="text-2xl font-semibold mb-4">Disaster Program Category Management</h2>

    <div class="flex items-center space-x-4">
        <x-bladewind::input type="text" wire:model.live.debounce.500ms="search" placeholder="Search categories..."
            class="border h-full" />

        <select wire:model.live.debounce.150ms="perPage" class="border rounded-md bw-raw-select w-20 mb-4">
            @foreach($perPageData as $data)
                <option value="{{ $data['value'] }}">{{ $data['label'] }}</option>
            @endforeach
        </select>
        <x-button wire:click="redirectToCreate" class="shrink-0 mb-4">Create Category</x-button>
    </div>

    <div>

        <div class="overflow-x-auto">
            <x-bladewind::table has_shadow="true" divider="thin">
                <x-slot name="header" class="bg-gray-50">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </x-slot>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td class="shrink-0">
                                <x-bladewind::button wire:click="redirectToEdit({{ $category->id }})" size="small"
                                    color="primary" icon="pencil-square">
                                    Edit
                                </x-bladewind::button>
                                <x-bladewind::button wire:click="deleteCategory({{ $category->id }})"
                                    wire:confirm="Are you sure to delete this?" size="small" color="red" icon="trash">
                                    Delete
                                </x-bladewind::button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-bladewind::table>
        </div>
    </div>


    <!-- Pagination links -->
    {{ $categories->links() }}
</div>