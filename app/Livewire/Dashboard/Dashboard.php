<?php

namespace App\Livewire\Dashboard;

use App\Models\Disaster;
use App\Models\DisasterProgram;
use App\Models\Donation;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
class Dashboard extends Component
{
    public $totalDonations;
    public $recentDonations;
    public $recentDisasters;
    public $recentPrograms;
    public $donationData = [];
    public $disasterData = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $this->totalDonations = Donation::where('status', 'verified')->sum('amount');

        $this->recentDonations = Donation::with('disasterProgram')
            ->where('status', 'verified')
            ->latest()
            ->take(5)
            ->get();

        $this->recentDisasters = Disaster::with('city.province')
            ->latest()
            ->take(5)
            ->get()
            ->filter(function ($disaster) {
                return $disaster->city && $disaster->city->province;
            });

        $this->recentPrograms = DisasterProgram::where('status', 'active')
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $this->donationData = [
            'labels' => Donation::where('status', 'verified')
                ->orderBy('created_at')
                ->pluck('created_at')
                ->map(fn($date) => $date->format('M'))
                ->unique()
                ->toArray(),
            'data' => Donation::where('status', 'verified')
                ->selectRaw('SUM(amount) as total')
                ->groupByRaw('MONTH(created_at)')
                ->pluck('total')
                ->toArray(),
        ];

        $this->disasterData = $this->getDisasterCountByProvince();
    }

    private function getDisasterCountByProvince()
    {
        $disasterCounts = Disaster::with('city.province')
            ->get()
            ->filter(function ($disaster) {
                return $disaster->city && $disaster->city->province;
            })
            ->groupBy(fn($disaster) => $disaster->city->province->name);

        $labels = $disasterCounts->keys()->toArray();
        $data = $disasterCounts->map->count()->values()->toArray();

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }


    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
