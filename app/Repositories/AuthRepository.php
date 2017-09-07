<?php

namespace App\Repositories;

use App\Model\Auth;

class AuthRepository extends Repository
{
    public function addAuth($data)
    {
        return Auth::create($data)->id;
    }
}