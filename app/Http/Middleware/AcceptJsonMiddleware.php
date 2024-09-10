<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcceptJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Accept') !== 'application/json') {
            $request->headers->set('Accept', 'application/json');
            // return response()->json(['error' => 'El encabezado Accept debe ser application/json'], Response::HTTP_BAD_REQUEST);
        }

        if ($request->header('Content-Type') !== 'application/json') {
            $request->headers->set('Content-Type', 'application/json');
            // return response()->json(['error' => 'El encabezado Content-Type debe ser application/json'], Response::HTTP_BAD_REQUEST);
        }
        return $next($request);
    }
}
