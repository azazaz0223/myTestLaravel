<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexUserRequest $request)
    {
        $this->authorize('viewAny', User::class);

        $users = new UserCollection($this->userService->findAll($request));

        return $this->successResponse($users, Response::HTTP_OK);
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
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $user = $this->userService->create($request->validated());

        return $this->successResponse($user, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', User::class);

        return $this->successResponse(new UserResource($user), Response::HTTP_OK);
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $user = $this->userService->update($request->validated(), $user);

        return $this->successResponse($user, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $this->userService->delete($user);

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}