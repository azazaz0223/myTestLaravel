<?php
namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [ 'except' => [ 'login', 'register' ] ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (! $token = auth()->attempt($request->all())) {
            return $this->errorResponse('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create(
            array_merge(
                $request->all(),
                [ 'password' => bcrypt($request->password) ]
            )
        );
        return response([ 'data' => $user ], Response::HTTP_CREATED);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
        auth()->logout();
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
        return response(
            [
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 3600,
                    'user' => auth()->user()
                ]
            ], Response::HTTP_OK
        );
    }
}