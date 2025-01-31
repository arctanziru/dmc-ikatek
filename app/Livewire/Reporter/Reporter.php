<?php

namespace App\Livewire\Reporter;

use App\Models\Disaster;
use App\Models\DisasterProgram;
use App\Models\Donation;
use Laravolt\Indonesia\Models\Province;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

#[Layout('components.layouts.reporter-dashboard')]
class Reporter extends Component
{
    public $totalDonations;
    public $totalPrograms;
    public $recentDonations;
    public $pendingDonations;
    public $recentDisasters;
    public $recentPrograms;
    public $fullFundedProgramCount;
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

        $this->pendingDonations = Donation::with('disasterProgram')
            ->where('status', 'pending')
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

        $this->totalPrograms = DisasterProgram::where('status', 'active')
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $this->recentPrograms = DisasterProgram::where('status', 'active')
            ->with([
                'category',
                'donations' => function ($query) {
                    $query->where('status', 'verified');
                }
            ])
            ->latest()
            ->take(5)
            ->get();

        $this->fullFundedProgramCount = DisasterProgram::where('status', 'active')
            ->where('target_donation', '>', 0)
            ->whereHas('donations', function ($query) {
                $query->where('status', 'verified');
            })
            ->withSum([
                'donations as total_verified_donations' => function ($query) {
                    $query->where('status', 'verified');
                }
            ], 'amount')
            ->havingRaw('total_verified_donations > target_donation')
            ->count();
        // Generate labels for each month from January to December
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        // Initialize donation data with zeros
        $donationAmounts = array_fill(0, 12, 0);

        $donations = Donation::where('status', 'verified')
            ->whereYear('donation_date', now()->year)
            ->selectRaw('MONTH(donation_date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        foreach ($donations as $month => $total) {
            $donationAmounts[$month - 1] = $total; // Subtract 1 to match array index
        }

        $this->donationData = [
            'labels' => $months,
            'data' => $donationAmounts,
        ];

        $this->disasterData = $this->getDisasterCountByProvince();
    }

    private function getDisasterCountByProvince()
    {
        $allProvinces = Province::pluck('name')->toArray();
        $provinceCounts = array_fill_keys($allProvinces, 0);

        $disasters = Disaster::with('city.province')
            ->where('status', 'active')
            ->get()
            ->filter(function ($disaster) {
                return $disaster->city && $disaster->city->province;
            });

        foreach ($disasters as $disaster) {
            $provinceName = $disaster->city->province->name;
            if (isset($provinceCounts[$provinceName])) {
                $provinceCounts[$provinceName]++;
            }
        }

        $labels = array_keys($provinceCounts);
        $data = array_values($provinceCounts);

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    public function render()
    {
        return view('livewire.reporter.reporter-dashboard');
    }
}
