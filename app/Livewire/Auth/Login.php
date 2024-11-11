<?php
namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login - DMC Ikatek-UH')]
class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        try {
            $this->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Email must be a valid email address.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 6 characters.',
            ]);
        } catch (ValidationException $e) {
            $this->addError('error', $e->getMessage());
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            session()->flash('success_login', "Glad to see you back, " . Auth::user()->name);

            // Check the user's role after logging in
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/dashboard');
            }else if($user->role === 'reporter')
            {
                return redirect()->intended('/report');
            }

            return redirect()->intended('/dashboard');
        }

        $this->addError('error', 'Invalid credentials. Please try again.');
    }

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
