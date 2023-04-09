<?php
namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private $authService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', [ 'except' => [ 'login', 'register' ] ]);

        $this->authService = $authService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(LoginAuthRequest $request)
    {
        $token = $this->authService->login($request->validated());

        if (! $token) {
            return $this->errorResponse('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegisterAuthRequest $request)
    {
        $user = $this->authService->register($request);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
        $this->authService->logout();
        return response([ 'data' => null ], Response::HTTP_NO_CONTENT);
    }

    /**
     * Refresh a token.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userProfile()
    {
        return response([ 'data' => auth()->user() ], Response::HTTP_OK);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function createNewToken($token)
    {
        return $this->successResponse(new TokenResource($token), Response::HTTP_OK);
    }
}