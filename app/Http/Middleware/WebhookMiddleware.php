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

class WebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken();
            $user = JWTAuth::authenticate($token);
            if (!$user) {
                throw new Exception();
            }
            $request['info'] = $user->toArray();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $th) {
            if ($th instanceof TokenInvalidException) {
                throw new UnauthorizedHttpException('Token is Invalid.', Response::HTTP_UNAUTHORIZED);
            }
            if ($th instanceof TokenExpiredException) {
                throw new UnauthorizedHttpException('Token is Expired.', Response::HTTP_UNAUTHORIZED);
            }
            throw new AccessDeniedHttpException('Access denid, user not found.', 422);
        }

        return $next($request);
    }
}
