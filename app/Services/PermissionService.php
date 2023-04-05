<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    private PermissionRepository $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function findAll()
    {
        return $this->permissionRepository->findAll();
    }
}