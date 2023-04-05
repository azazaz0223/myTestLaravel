<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // public function findAll($request)
    // {
    //     return $this->userRepository->findAll($request);
    // }

    public function create($request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $roles = $request['roles'];
        return $this->userRepository->create($request, $roles);
    }

// public function update($request, $product)
// {
//     $request['operator_id'] = auth()->user()->id;
//     return $this->userRepository->update($request, $product);
// }

// public function delete(Product $product)
// {
//     return $this->userRepository->delete($product);
// }
}