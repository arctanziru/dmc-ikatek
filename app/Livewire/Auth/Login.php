<?php

namespace App\Livewire\Auth;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login - DMC Ikatek FT-UH')]
class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        try {
            $request = Request::create('/', 'POST', [
                'email' => $this->email,
                'password' => $this->password,
            ]);
            $controller = app(AuthController::class);
            $response = $controller->login($request);
            $json = $response->getData(true);

            if ($json['status'] !== 'success') {
                return $this->addError('error', $json['message']);
            }

            $name = $json['data']['user']['name'];
            session()->flash('success_login', "Glad to see you back, $name!");
            return $this->redirect("/");
        } catch (\Exception $e) {
            $this->addError('error', $e->getMessage());
        }
    }

    public function mount()
    {
        if (auth()->check()) {
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
