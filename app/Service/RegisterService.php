<?php

namespace App\Service;

use App\Repository\RegisterRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    protected $registerRepo;

    public function __construct(RegisterRepository $registerRepo)
    {
        $this->registerRepo = $registerRepo;
    }

    public function userRegister($data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ];

        $this->registerRepo->create($userData);
    }
}
