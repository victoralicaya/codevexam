<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->to('/');
        }

        session()->flash('error', 'Email or password is incorrect!');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
