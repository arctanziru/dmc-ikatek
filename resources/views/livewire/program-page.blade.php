<div class="container mx-auto p-6">
    <!-- Search and Filters -->
    <div class="flex items-center justify-between mb-4">
        <!-- Search Input -->
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search programs..."
            class="border p-2 rounded w-1/3" />

        <!-- Status Filter -->
        <select wire:model="status" class="border p-2 rounded">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <!-- Add more status options as needed -->
        </select>

        <!-- Per Page Selector -->
        <select wire:model="perPage" class="border p-2 rounded">
            <option value="5">5 per page</option>
            <option value="10">10 per page</option>
            <option value="20">20 per page</option>
        </select>
    </div>

    <!-- Program Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($programs as $program)
            <x-program-card name="{{ $program->name }}" desc="{{ $program->description }}"
                target="{{ (int) $program->target_donation }}" totalDonation="{{ $program->donations->sum('amount') }}"
                category="{{ $program->category->name }}" id="{{ $program->id }}"
        createdAt="{{ $program->created_at->format('d M Y') }}" /> 
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $programs->links() }}
    </div>
</div>