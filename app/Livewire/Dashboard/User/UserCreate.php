<?php

namespace App\Livewire\Dashboard\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Create User - DMC Ikatek FT-UH')]
class UserCreate extends Component
{
    public UserForm $form;

    public function save()
    {
        $validatedData = $this->form->validate();

        User::create($validatedData);

        session()->flash('title',  'User Created');
        session()->flash('message', 'User "' . $validatedData['name'] . '" has been created.');

        return redirect()->route('users');
    }


    public function render()
    {
        return view('livewire.dashboard.user.user-create');
    }
}
