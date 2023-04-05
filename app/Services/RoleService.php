<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Role;

class RoleService
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function findAll()
    {
        return $this->roleRepository->findAll();
    }

    public function create($request)
    {
        $role = new Role();
        $role->name = $request['name'];
        $permissions = $request['permissions'];
        return $this->roleRepository->create($role, $permissions);
    }

    public function update($request, $role)
    {
        $role->name = $request['name'];
        $permissions = $request['permissions'];
        return $this->roleRepository->update($role, $permissions);
    }

    public function delete(Role $role)
    {
        return $this->roleRepository->delete($role);
    }
}