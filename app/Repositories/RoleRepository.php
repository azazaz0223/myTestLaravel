<?php

namespace App\Repositories;

use DB;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function create($role, $permissions)
    {
        $role = DB::transaction(function () use ($role, $permissions) {
            $role->save();
            $role->syncPermissions($permissions);
            return $role;
        });
        return $role;
    }

    public function update(Role $role, $permissions)
    {
        $role = DB::transaction(function () use ($role, $permissions) {
            $role->save();
            $role->syncPermissions($permissions);
            return $role;
        });
        return $role;
    }

    public function findAll()
    {
        return Role::all();
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
}