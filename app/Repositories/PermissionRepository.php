<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;



class PermissionRepository
{
    public function findAll()
    {
        return Permission::all();
    }
}