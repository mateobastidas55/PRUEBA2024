<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(
            fn(UnsupportedMediaTypeHttpException $e) => throw new JsonApi\UnsupportedMediaTypeHttpException(
                $e->getMessage(),
                $this->isHttpException($e) ? $e->getStatusCode() : 415
            )
        );

        $this->renderable(
            fn(BadRequestHttpException $e) => throw new JsonApi\BadRequestHttpException(
                $e->getMessage(),
                $this->isHttpException($e) ? $e->getStatusCode() : 400
            )
        );

        $this->renderable(
            fn(UnauthorizedHttpException $e) => throw new JsonApi\UnauthorizedHttpException(
                $e->getMessage(),
                $this->isHttpException($e) ? $e->getStatusCode() : 401
            )
        );

        $this->renderable(
            fn(AccessDeniedHttpException $e) => throw new JsonApi\AccessDeniedHttpException(
                $e->getMessage(),
                $this->isHttpException($e) ? $e->getStatusCode() : 403
            )
        );

        $this->renderable(
            fn(NotFoundHttpException $e) => throw new JsonApi\NotFoundHttpException(
                $e->getMessage(),
                $this->isHttpException($e) ? $e->getStatusCode() : 404
            )
        );

        // $this->renderable(
        //     fn(MethodNotAllowedHttpException $e) => throw new JsonApi\MethodNotAllowedHttpException(
        //         $e->getMessage(),
        //         $this->isHttpException($e) ? $e->getStatusCode() : 405
        //     )
        // );
    }
}
