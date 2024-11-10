<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Password Reset')]
class PasswordReset extends Component
{
    public $password;
    public $password_confirmation;

    protected $rules = [
        'password' => 'required|string|min:8|confirmed',
    ];

    public function resetPassword()
    {
        $this->validate();
        $user = auth()->user();
        $userDb = User::where('email', $user->email)->first();
        if ($userDb) {
            $userDb->password = Hash::make($this->password);
            $userDb->save();

            session()->flash('title', 'Password Reset');
            session()->flash('message', 'Password has been reset successfully.');
            return redirect()->route('login');
        }

        session()->flash('error', 'User not found.');
    }

    public function render()
    {
        return view('livewire.password-reset');
    }
}
