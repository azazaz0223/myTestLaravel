<?php

namespace App\Http\Controllers;

use App\Http\Resources\Permission\PermissionCollection;
use App\Http\Resources\Permission\PermissionResource;
use App\Services\PermissionService;
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

        $permissions = new PermissionCollection($this->permissionService->findAll());

        return $this->successResponse($permissions, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $this->authorize('view', Permission::class);

        return $this->successResponse(new PermissionResource($permission), Response::HTTP_OK);
    }
}