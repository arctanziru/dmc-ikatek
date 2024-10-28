@php
$perPageData = [
['label' => '5', 'value' => '5'],
['label' => '10', 'value' => '10'],
['label' => '15', 'value' => '15'],
['label' => '20', 'value' => '20'],
]
@endphp

<div class="p-6 space-y-4">
    <h2 class="text-2xl font-semibold mb-4">News Management</h2>

    <div class="flex items-center space-x-4 ">
        <x-bladewind::input
            type="text"
            wire:model.live.debounce.500ms="search"
            placeholder="Search news..."
            class="border h-full" />

        <select wire:model.live.debounce.150ms="perPage" class="border  rounded-md bw-raw-select w-20 mb-4">
            @foreach($perPageData as $data)
            <option value="{{ $data['value'] }}">{{ $data['label'] }}</option>
            @endforeach
        </select>
        <x-button wire:click="redirectToCreate" class="shrink-0 mb-4">Create User</x-button>
    </div>

    <x-bladewind::table has_shadow="true" divider="thin">
        <x-slot name="header" class="bg-gray-50">
            <th>Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Description</th>
            <th>Author</th>
            <th>Actions</th>
        </x-slot>
        <tbody>
            @foreach ($news as $newsItem)
            <tr>
                <td>{{ $newsItem->title }}</td>
                <td><img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-20 h-20 object-cover"></td>
                <td>{{ $newsItem->category }}</td>
                <td>{{ $newsItem->description }}</td>
                <td>{{ $newsItem->author }}</td>
                <td>
                    <x-bladewind::button wire:click="redirectToEdit({{ $newsItem->id }})" size="small" color="primary" icon="pencil-square">
                        Edit
                    </x-bladewind::button>
                    <x-bladewind::button wire:click="deleteNews({{ $newsItem->id }})" wire:confirm="Are you sure to delete this?" size="small" color="red" icon="trash">
                        Delete
                    </x-bladewind::button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </x-bladewind::table>

    <!-- Pagination links -->
    {{ $news->links() }}

    <!-- Show Notification -->
    @if (session()->has('message') && session()->has('title'))
    <script>
        showNotification("{{ session('title') }}", "{{ session('message') }}");
    </script>
    @endif
</div>