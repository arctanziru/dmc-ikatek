<?php

namespace App\Livewire;

use App\Models\DisasterProgram;
use App\Models\Donation;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.landing')]
#[Title(content: 'Donate - DMC Ikatek FT-UH')]
class DonatePage extends Component
{
    use WithFileUploads;

    public $donor_name;
    public $donor_organization;
    public $donor_email;
    public $amount;
    public $message;
    public $transfer_evidence;
    public $donation_date;
    public $disaster_program_id;

    public $programs = [];
    public $totalDonations;
    public $totalDonationsThisYear;
    public $programCount;
    public $programCountThisYear;
    public $donorCount;
    public $donorCountThisYear;

    protected $rules = [
        'donor_name' => 'required|string|max:255',
        'donor_organization' => 'nullable|string|max:255',
        'donor_email' => 'required|email|max:255',
        'amount' => 'required|numeric|min:0',
        'message' => 'nullable|string|max:500',
        'transfer_evidence' => 'required|file|max:5120',
        'donation_date' => 'nullable|date',
        'disaster_program_id' => 'nullable|exists:disaster_programs,id',
    ];

    public function mount()
    {
        $currentYear = Carbon::now()->year; // Get the current year

        // Retrieve all active programs
        $this->programs = DisasterProgram::where('status', 'active')->get();

        // Calculate total sum of all verified donations
        $this->totalDonations = Donation::where('status', 'verified')->sum('amount');

        // Calculate sum of verified donations for the current year
        $this->totalDonationsThisYear = Donation::where('status', 'verified')
            ->whereYear('donation_date', $currentYear) // Make sure 'donation_date' is the correct field
            ->sum('amount');

        // Count all active programs
        $this->programCount = DisasterProgram::count();

        // Count active programs created this year
        $this->programCountThisYear = DisasterProgram::whereYear('created_at', $currentYear) // Make sure 'created_at' is the correct field
            ->count();

        // Count all donors with verified status
        $this->donorCount = Donation::where('status', 'verified')->distinct('donor_email')->count('donor_email');

        // Count unique donors with verified status for the current year
        $this->donorCountThisYear = Donation::where('status', 'verified')
            ->whereYear('donation_date', $currentYear) // Make sure 'donation_date' is the correct field
            ->distinct('donor_email')
            ->count('donor_email');
    }


    public function save()
    {
        $this->validate();

        $transferEvidencePath = $this->transfer_evidence ? '/storage/' . $this->transfer_evidence->store('images/transfer_evidence', 'public') : null;
        $donationDate = (strtotime($this->donation_date) !== false) ? $this->donation_date : null;

        Donation::create([
            'donor_name' => $this->donor_name,
            'donor_organization' => $this->donor_organization,
            'donor_email' => $this->donor_email,
            'amount' => $this->amount,
            'message' => $this->message,
            'transfer_evidence' => $transferEvidencePath,
            'donation_date' => $donationDate ?? now()->toDateString(),
            'disaster_program_id' => $this->disaster_program_id,
        ]);

        session()->flash('title', 'Thank you for the donation!');
        session()->flash('message', 'Donation from "' . $this->donor_name . '" sent successfully.');

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.donate', [
            'programs' => $this->programs,
            'totalDonations' => $this->totalDonations,
            'totalDonationsThisYear' => $this->totalDonationsThisYear,
            'programCount' => $this->programCount,
            'programCountThisYear' => $this->programCountThisYear,
            'donorCount' => $this->donorCount,
            'donorCountThisYear' => $this->donorCountThisYear,
        ]);
    }
}
