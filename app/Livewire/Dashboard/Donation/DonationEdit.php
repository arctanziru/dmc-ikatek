<?php

namespace App\Livewire\Dashboard\Donation;

use App\Models\Donation;
use App\Models\DisasterProgram;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Donation - DMC Ikatek FT-UH')]
class DonationEdit extends Component
{
    use WithFileUploads;

    public $donation;
    public $donor_name;
    public $donor_organization;
    public $donor_email;
    public $amount;
    public $message;
    public $transfer_evidence;
    public $existingTransferEvidence;
    public $donation_date;
    public $disaster_program_id;

    public $programs = [];

    protected $rules = [
        'donor_name' => 'required|string|max:255',
        'donor_organization' => 'nullable|string|max:255',
        'donor_email' => 'required|email|max:255',
        'amount' => 'required|numeric|min:0',
        'message' => 'nullable|string|max:500',
        'transfer_evidence' => 'nullable|file|max:5120',
        'donation_date' => 'nullable|date',
        'disaster_program_id' => 'nullable|exists:disaster_programs,id',
    ];

    public function mount(Donation $donation)
    {
        $this->donation = $donation;
        $this->donor_name = $donation->donor_name;
        $this->donor_organization = $donation->donor_organization;
        $this->donor_email = $donation->donor_email;
        $this->amount = $donation->amount;
        $this->message = $donation->message;
        $this->existingTransferEvidence = $donation->transfer_evidence;
        $this->donation_date = $donation->donation_date;
        $this->disaster_program_id = $donation->disaster_program_id;

        $this->programs = DisasterProgram::all();
    }

    public function update()
    {
        if (!$this->transfer_evidence && !$this->existingTransferEvidence) {
            $this->addError('transfer_evidence', 'The transfer evidence is required.');
            return;
        }

        $this->validate();

        $transferEvidencePath = $this->existingTransferEvidence;
        if ($this->transfer_evidence) {
            if ($this->existingTransferEvidence) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $this->existingTransferEvidence));
            }
            $transferEvidencePath = '/storage/' . $this->transfer_evidence->store('images/transfer_evidence', 'public');
        }

        $this->donation->update([
            'donor_name' => $this->donor_name,
            'donor_organization' => $this->donor_organization,
            'donor_email' => $this->donor_email,
            'amount' => $this->amount,
            'message' => $this->message,
            'transfer_evidence' => $transferEvidencePath,
            'donation_date' => $this->donation_date,
            'disaster_program_id' => $this->disaster_program_id,
        ]);

        session()->flash('title', 'Donation Updated');
        session()->flash('message', 'Donation from "' . $this->donor_name . '" updated successfully.');

        return redirect()->route('dashboard.donation');
    }

    public function render()
    {
        return view('livewire.dashboard.donation.donation-edit');
    }
}
