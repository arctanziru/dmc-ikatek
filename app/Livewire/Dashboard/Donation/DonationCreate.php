<?php

namespace App\Livewire\Dashboard\Donation;

use App\Models\Donation;
use App\Models\DisasterProgram;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create Donation - DMC Ikatek FT-UH')]
class DonationCreate extends Component
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
        $this->programs = DisasterProgram::all();
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

        session()->flash('title', 'Donation Created');
        session()->flash('message', 'Donation from "' . $this->donor_name . '" created successfully.');

        return redirect()->route('dashboard.donation');
    }

    public function render()
    {
        return view('livewire.dashboard.donation.donation-create');
    }
}
