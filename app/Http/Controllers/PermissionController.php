<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return new PermissionCollection($permissions);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }
}