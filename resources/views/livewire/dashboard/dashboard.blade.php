@php
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

<main class="p-2 md:p-4 lg:p-6 flex flex-col gap-1 md:gap-2 lg:gap-4 bg-white-light">
    @if (session()->has('message'))
    <script>
        showNotification("{{ session('message') }}");
    </script>
    @endif


    <!-- Total Donations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-1 md:gap-2 lg:gap-4">

        <div class="p-6  flex flex-col bg-primary text-primary-contrast rounded-lg shadow">
            <h3 class="font-light text-[18px]">Verified Donations Total</h3>
            <p class="text-[36px]">Rp. {{ formatCurrency($totalDonations) }}</p>
            <p class="text-[18px] font-semibold">Raised</p>
        </div>
        <div class="p-6  flex flex-col bg-dark-light text-primary-contrast rounded-lg shadow">
            <h3 class="font-light text-[18px]">Total Active Program</h3>
            <p class="text-[36px]"> {{$totalPrograms}} Program</p>
        </div>
    </div>

    <!-- Recent Donations -->
    <section class="grid grid-cols-1 gap-1 md:gap-2 lg:gap-4 lg:grid-cols-2">

        <div class="bg-white flex-col flex gap-1 md:gap-2 lg:gap-4 rounded shadow p-6">
            <h3 class="font-semibold text-lg">Recent Verified Donations</h3>

            <div class="flex flex-col gap-0 h-[252px] bg-white-light/30 rounded-md overflow-y-auto">
                @if($recentDonations->isEmpty())
                <!-- Show empty message centered in the container if there are no recent donations -->
                <div class="flex flex-col items-center justify-center h-full text-dark/60">
                    <p>No recent donations available.</p>
                </div>
                @else
                @foreach($recentDonations as $index => $donation)
                <div class="flex flex-col items-center">
                    <section
                        class="flex p-2 gap-3 w-full cursor-pointer items-center rounded bg-transparent hover:bg-dark/5 duration-200">
                        <div class="font-semibold text-[32px] min-w-8 text-center text-dark">{{ $index + 1 }}</div>
                        <!-- Increment index -->
                        <div class="flex gap-1 flex-1 md:gap-2 lg:gap-4 w-full justify-between">
                            <div>
                                <p class="text-dark text-ellipsis line-clamp-1"><strong>From :</strong>
                                    {{ $donation->donor_name ?? "N/A" }}
                                </p>
                                <p class="text-dark text-ellipsis line-clamp-1"><strong>Program :</strong>
                                    {{ $donation->disasterProgram->name ?? "N/A" }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end">
                                <p class="text-secondary text-[18px] font-bold">
                                    +Rp.{{ number_format($donation->amount, 2) }}
                                </p>
                                <p class="text-dark/80 text-[14px]">{{ $donation->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </section>
                    <div class="w-[95%] bg-dark/10 h-[1px]"></div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="w-full text-center">
                <a class="text-dark font-bold text-[16px] hover:underline duration-200 cursor-pointer hover:text-secondary"
                    href="/dashboard/donation">
                    See All Donation
                </a>
            </div>
        </div>
        <div class="bg-white flex-col flex gap-1 md:gap-2 lg:gap-4 rounded shadow p-6">
            <h3 class="font-semibold text-lg">Recent Pending Donations</h3>

            <div class="flex flex-col gap-0 h-[252px] bg-white-light/30 rounded-md overflow-y-auto">
                @if($pendingDonations->isEmpty())
                <!-- Show empty message centered in the container if there are no recent donations -->
                <div class="flex flex-col items-center justify-center h-full text-dark/60">
                    <p>No recent pending donations available.</p>
                </div>
                @else
                @foreach($pendingDonations as $index => $donation)
                <div class="flex flex-col items-center">
                    <section
                        class="flex p-2 gap-3 w-full cursor-pointer items-center rounded bg-transparent hover:bg-dark/5 duration-200">
                        <div class="font-semibold text-[32px] min-w-8 text-center text-dark">{{ $index + 1 }}</div>
                        <!-- Increment index -->
                        <div class="flex gap-1 flex-1 md:gap-2 lg:gap-4 w-full justify-between">
                            <div>
                                <p class="text-dark text-ellipsis line-clamp-1"><strong>From :</strong>
                                    {{ $donation->donor_name ?? "N/A" }}
                                </p>
                                <p class="text-dark text-ellipsis line-clamp-1"><strong>Program :</strong>
                                    {{ $donation->disasterProgram->name ?? "N/A" }}
                                </p>
                            </div>
                            <div class="flex flex-col items-end">
                                <p class="text-secondary text-[18px] font-bold">
                                    +Rp.{{ number_format($donation->amount, 2) }}
                                </p>
                                <p class="text-dark/80 text-[14px]">{{ $donation->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </section>
                    <div class="w-[95%] bg-dark/10 h-[1px]"></div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="w-full text-center">
                <a class="text-dark font-bold text-[16px] hover:underline duration-200 cursor-pointer hover:text-secondary"
                    href="/dashboard/donation">
                    See All Donation
                </a>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-1 md:gap-2 lg:gap-4">

        <div class="bg-white flex-col flex gap-1 md:gap-2 lg:gap-4 rounded shadow p-6">
            <h3 class="font-semibold text-lg">Recent Active Disaster</h3>

            <div class="flex flex-col gap-0 h-[252px] bg-white-light/30 rounded-md overflow-y-auto">
                @if($recentPrograms->isEmpty())
                <!-- Show empty message centered in the container if there are no recent donations -->
                <div class="flex flex-col items-center justify-center h-full text-dark/60">
                    <p>No Recent Disaster</p>
                </div>
                @else
                @foreach($recentDisasters as $index => $disaster)
                <div class="flex flex-col items-center">
                    <section
                        class="flex p-2 gap-3 w-full cursor-pointer items-center rounded bg-transparent hover:bg-dark/5 duration-200">
                        <div class="font-semibold text-[32px] min-w-8 text-center text-dark">{{ $index + 1 }}</div>
                        <!-- Increment index -->
                        <div class="flex gap-1 flex-1 md:gap-2 lg:gap-4 w-full items-end justify-between">
                            <div class="flex flex-col">
                                <p class="text-secondary text-ellipsis line-clamp-1 text-[18px] capitalize font-bold ">
                                    {{ $disaster->name ?? "N/A" }}
                                </p>
                                <p class="text-dark text-ellipsis line-clamp-1 capitalize"><strong>
                                        Desc :
                                    </strong>
                                    {{ ucwords(strtolower($disaster->description)) }}
                                </p>
                                <p class="text-dark text-[14px] capitalize font-light">
                                    {{ ucwords(strtolower($disaster->city->name)) }},
                                    {{ucwords(strtolower($disaster->city->province->name)) }}
                                </p>
                            </div>
                            <div class="flex flex-col justify-end h-full  items-end">
                                <p class="text-dark/80 text-[14px]">{{ $disaster->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </section>
                    <div class="w-[95%] bg-dark/10 h-[1px]"></div>
                </div>

                @endforeach
                @endif
            </div>

            <div class="w-full text-center">
                <a class="text-dark font-bold text-[16px] hover:underline duration-200 cursor-pointer hover:text-secondary"
                    href="/dashboard/disaster">
                    See All Disaster
                </a>
            </div>
        </div>
        <div class="bg-white flex-col flex gap-1 md:gap-2 lg:gap-4 rounded shadow p-6">
            <h3 class="font-semibold text-lg">Recent Active Program</h3>

            <div class="flex flex-col gap-0 h-[252px] bg-white-light/30 rounded-md overflow-y-auto">
                @if($recentPrograms->isEmpty())
                <!-- Show empty message centered in the container if there are no recent programs -->
                <div class="flex flex-col items-center justify-center h-full text-dark/60">
                    <p>No Recent Disaster</p>
                </div>
                @else
                @foreach($recentPrograms as $index => $program)
                @php
                // Calculate the percentage of funds raised
                $raised = $program->donations->sum('amount');
                !$target = $program->target_donation;
                $percentage = $target > 0 ? min(($raised / $target) * 100, 100) : 0; // Cap at 100%
                @endphp
                <div class="flex flex-col w-full  items-center">
                    <section
                        class="flex p-2 gap-3 w-full cursor-pointer items-center rounded bg-transparent hover:bg-dark/5 duration-200">
                        <div class="font-semibold text-[32px] min-w-8 text-center text-dark">{{ $index + 1 }}</div>
                        <!-- Increment index -->
                        <div class="flex w-full flex-1 flex-col items-end">
                            <div class="flex flex-col w-full">
                                <p class="text-secondary text-ellipsis line-clamp-1 text-[18px] capitalize font-bold ">
                                    {{ $program->name ?? "N/A" }}
                                </p>
                                <div class="flex flex-col">
                                    <!-- Progress bar -->
                                    <div
                                        class="w-full h-[12px] {{ !$target || $target === 0 ? "hidden" : ""  }} bg-dark/20 rounded-lg overflow-hidden relative">
                                        <div class="h-full bg-primary rounded-lg w-[{{$percentage}}%]">
                                        </div>
                                        <p
                                            class="absolute right-2 top-0 bottom-0 flex items-center text-[14px] font-bold text-dark/80">
                                            {{ round($percentage) }}%
                                        </p>
                                    </div>
                                    <!-- Raised and Target amounts -->
                                    <div class="text-[14px] font-medium flex justify-between">
                                        <p><strong>Raised :</strong> Rp. {{ number_format($raised, 0, ',', '.') }}</p>
                                        <p class="{{ !$target || $target === 0 ? "hidden" : ""  }}"><strong>Target
                                                :</strong> Rp. {{ number_format($target, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col justify-end h-full items-end">
                                <p class="text-dark/80 text-[14px]">{{ $program->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </section>
                    <div class="w-[95%] bg-dark/10 h-[1px]"></div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="w-full text-center">
                <a class="text-dark font-bold text-[16px] hover:underline duration-200 cursor-pointer hover:text-secondary"
                    href="/dashboard/disaster/program">
                    See All Program
                </a>
            </div>
        </div>

    </section>
    <!-- Graph Section -->
    {{$disasterData['data'][0]}}

    <!-- Graph Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Donations Chart -->
        <div class="bg-white rounded shadow p-4">
            <h3 class="font-semibold text-lg">Donations Over Time</h3>
            <canvas id="donationsChart" height="360" class="mt-4"></canvas>
        </div>

        <!-- Disaster Provinces Chart -->
        <div class="bg-white rounded shadow p-4">
            <h3 class="font-semibold text-lg">Disaster Provinces</h3>
            <!-- Remove any centering classes or styles from the canvas -->
            <canvas id="disastersChart" height="360" class="mt-4"></canvas>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:init', function() {
            var donationsCtx = document.getElementById('donationsChart');
            if (donationsCtx) {
                var donationsChart = new Chart(donationsCtx.getContext('2d'), {
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
                        maintainAspectRatio: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                            }
                        }
                    }
                });
            } else {
                console.error('Element with ID "donationsChart" not found');
            } // Disasters Chart


            var disastersCtx = document.getElementById('disastersChart');
            if (disastersCtx) {
                var disastersChart = new Chart(disastersCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: @json($disasterData['labels']),
                        datasets: [{
                            label: 'Disasters',
                            data: @json($disasterData['data']),
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                labels: {
                                    usePointStyle: true
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });
            } else {
                console.error('Element with ID "disastersChart" not found');
            }
        });
    </script>

</main>