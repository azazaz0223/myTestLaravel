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

// public function findAll()
// {
//     return $this->authRepository->findAll();
// }

// public function create($request)
// {
//     return $this->authRepository->create($request);
// }

// public function update($request, $cate)
// {
//     $request['operator_id'] = auth()->user()->id;
//     return $this->authRepository->update($request, $cate);
// }

// public function delete(Cate $cate)
// {
//     return $this->authRepository->delete($cate);
// }
}