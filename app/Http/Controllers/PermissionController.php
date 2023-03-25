<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:permission-list')->only('index');
        $this->middleware('permission:permission-show')->only('show');
    }

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