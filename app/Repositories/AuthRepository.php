<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Models\Cate;
use App\Models\User;

class AuthRepository
{
    public function register(RegisterAuthRequest $request)
    {
        return User::create(
            array_merge(
                $request->validated(),
                [ 'password' => bcrypt($request->password) ]
            )
        );
    }
}