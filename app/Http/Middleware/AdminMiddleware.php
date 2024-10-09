<?php

namespace App\Http\Middleware;

use App\Exceptions\JsonApi\AccessDeniedHttpException;
use App\Exceptions\JsonApi\UnauthorizedHttpException;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request['info']['id_rol'] != 2) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'sin permisos.'
                ],
                422
            );
        }

        return $next($request);
    }
}
