<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return new RoleCollection($roles);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles', 'name')
            ],
            'permissions' => 'required|array',
            'permissions.*' => [
                'required',
                Rule::exists('permissions', 'id')
            ]
        ]);

        $role = Role::create([ 'name' => $request->name ])->refresh();

        $role->syncPermissions($request->permissions);

        return response($role, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
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
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role->name, 'name')
            ],
            'permissions' => 'required|array',
            'permissions.*' => [
                'required',
                Rule::exists('permissions', 'id')
            ]
        ]);

        $role->save([ 'name' => $request->name ]);

        $role->syncPermissions($request->permissions);

        return response($role, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}