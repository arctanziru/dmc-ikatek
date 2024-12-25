<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('User Management')]
class UserManagement extends Component
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
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.dashboard.user.user-management', ['users' => $users]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('users.create');
    }

    public function redirectToEdit($userId)
    {
        return redirect()->route('users.edit', ['user' => $userId]);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->delete();

        session()->flash('title', 'User Deleted');
        session()->flash('message', 'User "' . $user->name . '" has been deleted.');

        return redirect()->route('users');
    }
}
