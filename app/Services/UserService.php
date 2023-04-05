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

    public function findAll($request)
    {
        return $this->userRepository->findAll($request);
    }

    public function create($request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $roles = $request['roles'];
        return $this->userRepository->create($user, $roles);
    }

    public function update($request, $user)
    {
        $user->name = $request['name'] ?? $user->name;
        $user->email = $request['email'] ?? $user->email;

        if (isset($request['password'])) {
            $user->password = bcrypt($request['password']);
        }

        $roles = $request['roles'] ?? null;

        return $this->userRepository->update($user, $roles);
    }

    public function delete(User $user)
    {
        return $this->userRepository->delete($user);
    }
}