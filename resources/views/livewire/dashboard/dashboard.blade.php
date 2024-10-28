<div class="p-6 space-y-6">
    @if (session()->has('message'))
    <script>
        showNotification("{{ session('message') }}");
    </script>
    @endif

    <!-- Total Donations -->
    <div class="p-4 bg-primary-light text-primary-contrast rounded shadow">
        <h3 class="font-semibold text-lg">Total Verified Donations</h3>
        <p class="text-3xl">{{ number_format($totalDonations, 2) }}</p>
    </div>

    <!-- Recent Donations -->
    <div class="bg-white rounded shadow p-6">
        <h3 class="font-semibold text-lg mb-4">Recent Donations</h3>
        <ul class="space-y-3">
            @foreach($recentDonations as $donation)
            <li class="flex justify-between p-3 bg-gray-100 rounded">
                <div>
                    <p><strong>Program:</strong> {{ $donation->disasterProgram->name }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($donation->amount, 2) }}</p>
                </div>
                <div class="text-gray-500 text-sm">{{ $donation->created_at->format('d M Y') }}</div>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Disasters -->
    <div class="bg-white rounded shadow p-6">
        <h3 class="font-semibold text-lg mb-4">Recent Active Disasters</h3>
        <ul class="space-y-3">
            @foreach($recentDisasters as $disaster)
            <li class="p-3 bg-gray-100 rounded">
                <p><strong>Name:</strong> {{ $disaster->name }}</p>
                <p><strong>Location:</strong> {{ $disaster->district->name }}, {{ $disaster->district->city->name }}, {{ $disaster->district->city->province->name }}</p>
                <p><strong>Started on:</strong> {{ $disaster->start_date->format('d M Y') }}</p>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Disaster Programs -->
    <div class="bg-white rounded shadow p-6">
        <h3 class="font-semibold text-lg mb-4">Recent Active Programs</h3>
        <ul class="space-y-3">
            @foreach($recentPrograms as $program)
            <li class="p-3 bg-gray-100 rounded">
                <p><strong>Program Name:</strong> {{ $program->name }}</p>
                <p><strong>Category:</strong> {{ $program->category->name }}</p>
                <p class="text-gray-500 text-sm">{{ $program->created_at->format('d M Y') }}</p>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Graph Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Donations Chart -->
        <div class="bg-white rounded shadow p-4">
            <h3 class="font-semibold text-lg">Donations Over Time</h3>
            <canvas id="donationsChart" class="mt-4 h-48"></canvas>
        </div>

        <!-- Disasters Chart -->
        <div class="bg-white rounded shadow p-4">
            <h3 class="font-semibold text-lg">Disaster Types</h3>
            <canvas id="disastersChart" class="mt-4 h-48"></canvas>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:load', function() {
            var donationsCtx = document.getElementById('donationsChart').getContext('2d');
            new Chart(donationsCtx, {
                type: 'line',
                data: {
                    labels: @json($donationData['labels']),
                    datasets: [{
                        label: 'Donations',
                        data: @json($donationData['data']),
                        borderColor: '#dc8630',
                        backgroundColor: 'rgba(220, 134, 48, 0.2)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Disasters Chart
            var disastersCtx = document.getElementById('disastersChart').getContext('2d');
            new Chart(disastersCtx, {
                type: 'doughnut', // Doughnut chart for disaster types
                data: {
                    labels: @json($disasterData['labels']),
                    datasets: [{
                        label: 'Disasters',
                        data: @json($disasterData['data']),
                        backgroundColor: ['#35408D', '#5966B0', '#2A336E', '#b36d27'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>

</div>