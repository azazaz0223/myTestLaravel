<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResource;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        $permissions = $this->permissionService->findAll();
        return new PermissionCollection($permissions);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $this->authorize('view', Permission::class);

        return new PermissionResource($permission);
    }
}