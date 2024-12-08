@php
$perPageData = [
['label' => '5', 'value' => '5'],
['label' => '10', 'value' => '10'],
['label' => '15', 'value' => '15'],
['label' => '20', 'value' => '20'],
];
@endphp

<div class="p-6 space-y-4">
  <h2 class="text-2xl font-semibold mb-4">Area of Work Management</h2>

  <div class="flex items-center space-x-4">
    <x-bladewind::input type="text" wire:model.live.debounce.500ms="search" placeholder="Search area of works..."
      class="border h-full" />

    <select wire:model.live.debounce.150ms="perPage" class="border rounded-md bw-raw-select w-20 mb-4">
      @foreach($perPageData as $data)
      <option value="{{ $data['value'] }}">{{ $data['label'] }}</option>
      @endforeach
    </select>

    <x-button wire:click="redirectToCreate" class="shrink-0 mb-4">Create Area of Work</x-button>
  </div>

  <div>
    <div class="overflow-x-auto">
      <x-bladewind::table has_shadow="true" divider="thin">
        <x-slot name="header" class="bg-gray-50">
          <th>Name</th>
          <th>Description</th>
          <th>Short Description</th>
          <th>Image</th>
          <th>Cover Image</th>
          <th>Actions</th>
        </x-slot>
        <tbody>
          @foreach ($areaOfWorks as $areaOfWork)
          <tr>
            <td>{{ $areaOfWork->name }}</td>
            <td>{{ $areaOfWork->description }}</td>
            <td>{{ $areaOfWork->short_description }}</td>
            <td>
              @if ($areaOfWork->image)
              <img src="{{ asset('storage/' . $areaOfWork->image) }}" alt="Image" class="w-20 h-20 object-cover rounded-md">
              @else
              <span>No Image</span>
              @endif
            </td>
            <td>
              @if ($areaOfWork->cover_image)
              <img src="{{ asset('storage/' . $areaOfWork->cover_image) }}" alt="Cover Image" class="w-20 h-20 object-cover rounded-md">
              @else
              <span>No Cover Image</span>
              @endif
            </td>

            <td class="shrink-0">
              <x-bladewind::button wire:click="redirectToEdit({{ $areaOfWork->id }})" size="small"
                color="primary" icon="pencil-square">
                Edit
              </x-bladewind::button>
              <x-bladewind::button wire:click="deleteAreaOfWork({{ $areaOfWork->id }})"
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

  {{ $areaOfWorks ->links() }}
</div>