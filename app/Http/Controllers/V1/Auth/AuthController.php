<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\user\LoginParameters;
use App\OpenApi\RequestBodies\user\LoginRequestBody;
use App\OpenApi\Responses\user\LoginResponse;
use Illuminate\Http\Response;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\user\ResponseLogoutResponse;
use App\OpenApi\Responses\user\ResponseMeResponse;
use App\OpenApi\SecuritySchemes\auth\loginSecurityScheme;
use App\OpenApi\SecuritySchemes\auth\TokenAveSecuritySecurityScheme;

#[OpenApi\PathItem]
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(id: 'LoginUserRequest', tags: ['apiResource'])]
    #[OpenApi\RequestBody(factory: LoginRequestBody::class)]
    #[OpenApi\Response(factory: LoginResponse::class, statusCode: Response::HTTP_OK)]
    #[OpenApi\Parameters(factory: LoginParameters::class)]
    public function login()
    {
        try {
            $credentials = request(['email', 'password']);
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(id: 'MeUserRequest', tags: ['apiResource'], security: TokenAveSecuritySecurityScheme::class)]
    #[OpenApi\Response(factory: ResponseMeResponse::class, statusCode: Response::HTTP_OK)]
    public function me()
    {
        try {
            return response()->json(auth()->user());
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(id: 'LogoutUserRequest', tags: ['apiResource'], security: TokenAveSecuritySecurityScheme::class)]
    #[OpenApi\Response(factory: ResponseLogoutResponse::class, statusCode: Response::HTTP_OK)]
    public function logout()
    {
        try {
            auth()->logout();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Successfully logged out'
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(id: 'RefreshUserRequest', tags: ['apiResource'])]
    #[OpenApi\Response(factory: LoginResponse::class, statusCode: Response::HTTP_OK)]
    #[OpenApi\Parameters(factory: LoginParameters::class)]
    public function refresh()
    {
        try {
            return response()->json([
                'access_token' => auth()->refresh(),
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
