<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });

        // 400
        $this->renderable(function (BadRequestHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'err' => 'ERR_BAD_REQUEST',
                    'msg' => $e->getMessage(),
                ]);
            }
        });

        // 401
        $this->renderable(function (UnauthorizedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'err' => 'ERR_INVALID_REFRESH_TOKEN',
                    'msg' => $e->getMessage(),
                ]);
            }
        });

        // 403
        $this->renderable(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'err' => 'ERR_FORBIDDEN_ACCESS',
                    'msg' => $e->getMessage(),
                ]);
            }
        });

        // 404
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'err' => 'ERR_NOT_FOUND',
                    'msg' => $e->getMessage(),
                ]);
            }
        });

        // 500
        $this->renderable(function (ServiceUnavailableHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 500,
                    'err' => 'ERR_INTERNAL_ERROR',
                    'msg' => 'unable to connect into database',
                ]);
            }
        });

    }
}
