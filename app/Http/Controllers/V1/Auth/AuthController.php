<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    public function login()
    {
        // Obtener el encabezado Authorization
        $authorizationHeader = request()->header('Authorization');

        // Verificar si el encabezado Authorization comienza con "Basic "
        if (strpos($authorizationHeader, 'Basic ') === 0) {
            // Obtener la parte codificada en base64
            $base64Credentials = substr($authorizationHeader, 6);

            // Decodificar las credenciales en base64
            $decodedCredentials = base64_decode($base64Credentials);

            // Separar usuario y contraseña
            list($email, $password) = explode(':', $decodedCredentials, 2);

            // Intentar autenticar al usuario con las credenciales decodificadas
            $credentials = ['email' => $email, 'password' => $password];

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Retornar el token JWT si la autenticación es exitosa
            return $this->respondWithToken($token);
        }

        // Si no se proporciona el encabezado Authorization o no está bien formado
        return response()->json(['error' => 'Invalid Authorization Header'], 400);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
