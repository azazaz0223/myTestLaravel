<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Services\RoleService;
use App\Traits\ApiResponseTrait;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = new RoleCollection($this->roleService->findAll());

        return $this->successResponse($roles, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $role = $this->roleService->create($request->validated());

        return response($role, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('view', Role::class);

        return new RoleResource($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', Role::class);

        $role = $this->roleService->update($request->validated(), $role);

        return response($role, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);

        $this->roleService->delete($role);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}