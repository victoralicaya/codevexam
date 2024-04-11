<?php

namespace App\Livewire;

use App\Models\User;
use App\Service\RegisterService;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password;

    public function register()
    {
        $this->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8'
        ]);

        app(RegisterService::class)->userRegister([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        session()->flash('message', 'You have successfully registered! You can now login to your account.');

        return redirect()->to('login');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
