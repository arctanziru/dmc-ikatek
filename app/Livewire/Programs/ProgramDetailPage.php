<?php

namespace App\Livewire\Programs;

use App\Models\DisasterProgram;
use App\Models\Donation;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.landing')]
#[Title(content: 'Program Detail - DMC Ikatek-UH')]
class ProgramDetailPage extends Component
{
    use WithFileUploads;

    public $program;
    public $totalDonation;
    public $program_category;
    public $disaster; // Property to hold the related disaster
    public $donor_name;
    public $donor_organization;
    public $donor_email;
    public $amount;
    public $message;
    public $transfer_evidence;
    public $donation_date;

    protected $rules = [
        'donor_name' => 'required|string|max:255',
        'donor_organization' => 'nullable|string|max:255',
        'donor_email' => 'required|email|max:255',
        'amount' => 'required|numeric|min:0',
        'message' => 'nullable|string|max:500',
        'transfer_evidence' => 'required|file|max:5120',
        'donation_date' => 'nullable|date',
    ];

    public function mount($id)
    {
        // Retrieve the specific program with related data, including city and user of the disaster
        $this->program = DisasterProgram::with([
            'category',
            'disaster' => function ($query) {
                $query->with(['city', 'user']); // Eager load city and user for the related disaster
            },
            'donations' => function ($query) {
                $query->where('status', 'verified'); // Filter only verified donations
            }
        ])->findOrFail($id);

        // Calculate the total donation amount for this program
        $this->totalDonation = $this->program->donations->sum('amount');

        // Get the program category
        $this->program_category = $this->program->category->name ?? 'N/A';

        // Get all attributes of the related disaster (including city and user)
        $this->disaster = $this->program->disaster ?? null;
    }

    public function save()
    {
        $this->validate();

        $transferEvidencePath = $this->transfer_evidence ? '/storage/' . $this->transfer_evidence->store('images/transfer_evidence', 'public') : null;
        $donationDate = (strtotime($this->donation_date) !== false) ? $this->donation_date : null;

        // Create a new donation associated with the current program
        Donation::create([
            'donor_name' => $this->donor_name,
            'donor_organization' => $this->donor_organization,
            'donor_email' => $this->donor_email,
            'amount' => $this->amount,
            'message' => $this->message,
            'transfer_evidence' => $transferEvidencePath,
            'donation_date' => $donationDate ?? now()->toDateString(),
            'disaster_program_id' => $this->program->id,
        ]);

        session()->flash('title', 'Donation Created');
        session()->flash('message', 'Donation from "' . $this->donor_name . '" created successfully.');

        // Clear all fields after successful submission
        $this->reset(['donor_name', 'donor_organization', 'donor_email', 'amount', 'message', 'transfer_evidence', 'donation_date']);
    }

    public function render()
    {
        return view('livewire.programs.program-detail-page', [
            'program' => $this->program,
            'totalDonation' => $this->totalDonation,
            'program_category' => $this->program_category,
            'disaster' => $this->disaster, // Pass all disaster attributes (including city and user) to the view
        ]);
    }
}
