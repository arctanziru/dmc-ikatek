<?php

namespace App\Livewire\Dashboard\Donation;

use App\Models\Donation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('Donation Management')]
class DonationManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search', 'perPage'];

    public function mount()
    {
        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $donations = Donation::with('disasterProgram')
            ->where(function ($query) {
                $query->where('donor_name', 'like', '%' . $this->search . '%')
                    ->orWhere('donor_organization', 'like', '%' . $this->search . '%')
                    ->orWhere('donor_email', 'like', '%' . $this->search . '%')
                    ->orWhereHas('disasterProgram', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('donation_date', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.donation.donation-management', [
            'donations' => $donations,
        ]);
    }

    public function redirectToEdit($donationId)
    {
        return redirect()->route('dashboard.donation.edit', ['donation' => $donationId]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.donation.create');
    }

    public function updateDonationStatus($donationId, $status)
    {
        $donation = Donation::find($donationId);
        if ($donation) {
            $donation->status = $status;
            $donation->save();
        }

        session()->flash('title', 'Donation updated');
        session()->flash('message', 'Donation from "' . $donation->donor_name . '" updated successfully.');
    }

    public function deleteDonation($donationId)
    {
        $donation = Donation::find($donationId);
        if ($donation) {
            $donation->delete();
        }

        session()->flash('title', 'Donation deleted');
        session()->flash('message', 'Donation from "' . $donation->donor_name . '" deleted successfully.');

        return redirect()->route('dashboard.donation');
    }
}
