<?php

namespace App\Services;

use App\Models\Cate;
use App\Repositories\AuthRepository;

class AuthService
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($request)
    {
        return auth()->attempt($request);
    }

    public function register($request)
    {
        return $this->authRepository->register($request);
    }

    public function logout()
    {
        return auth()->logout();
    }
}