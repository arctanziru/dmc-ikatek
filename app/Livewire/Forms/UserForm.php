<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|string|unique:users,username|max:255')]
    public $username;

    #[Validate('required|email|unique:users,email')]
    public $email;

    #[Validate('required|min:6')]
    public $password;

    #[Validate('required|in:admin,reporter,user')]
    public $role;
}
