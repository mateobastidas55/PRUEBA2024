<?php

namespace App\Http\Middleware;

use App\Exceptions\JsonApi\UnauthorizedHttpException;
use App\Tools\Tools;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAveAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization') ?
            $request->header('Authorization') :
            $request->header('x-csrf-token');


        if (!$token) {

            throw new UnauthorizedHttpException(
                message: 'No estás autenticado, verifica tus credenciales y vuelve a intentarlo.',
                code: Response::HTTP_UNAUTHORIZED,
            );
        }

        try {
            $data = Tools::tokenValidator($token);
        } catch (\Throwable $e) {
            throw new UnauthorizedHttpException(
                message: $e->getMessage(),
                code: Response::HTTP_UNAUTHORIZED,
            );
        }

        if (strtolower($data['rol']) !== 'administrador') {

            throw new UnauthorizedHttpException(
                message: "No se encuentra autorizado para realizar esta acción.",
                code: Response::HTTP_FORBIDDEN,
            );
        }

        $request["info"] = $data;

        return $next($request);
    }
}
