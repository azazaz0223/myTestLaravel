<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $query = User::query();


        if (isset($request->name)) {
            $query->where('name', 'like', $request->name . "%");
        }


        $users = $query->orderBy('id', 'desc')
            ->paginate($limit)
            ->appends($request->query());

        return new UserCollection($users);
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
            'name' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')
            ],
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array',
            'roles.*' => [
                'required',
                Rule::exists('roles', 'id'),
            ]
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->roles);

        return response($user, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'string',
            'email' => [
                'string',
                // 'email',
                Rule::unique('users', 'email')->ignore($user->email, 'email')
            ],
            'password' => 'string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => [
                'required',
                Rule::exists('roles', 'id'),
            ]
        ]);

        $user->name = $request->name ?? $request->name;
        $user->email = $request->email ?? $request->email;
        $user->password = $request->password ?? bcrypt($request->password);
        $user->save();

        if (isset($request->roles)) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        return response($user, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}