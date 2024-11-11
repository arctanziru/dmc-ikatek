<?php

namespace App\Livewire\Dashboard\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Edit User - DMC Ikatek-UH')]
class UserEdit extends Component
{
    public UserForm $form;
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form = new UserForm($this, 'form');
        $this->form->fill([
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
        ]);
    }

    public function save()
    {
        $validatedData = $this->form->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $this->user->id . '|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'role' => 'required|in:admin,reporter,user',
        ]);

        $this->user->update($validatedData);

        session()->flash('title', 'User Updated');
        session()->flash('message', 'User "' . $validatedData['name'] . '" has been updated.');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.dashboard.user.user-edit');
    }
}
