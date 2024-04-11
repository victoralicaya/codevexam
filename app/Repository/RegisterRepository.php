<?php

namespace App\Repository;

use App\Models\User;

class RegisterRepository
{
    public function create(array $data)
    {
        return User::create($data);
    }
}
