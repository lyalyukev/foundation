<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
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
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => 'Entry for ' . str_replace('App', '', $exception->getModel()) . ' not found',
                    'code' => 404
                ],
                    404);
            }
            if ($exception instanceof InvalidArgumentException) {
                return response()->json([
                    'error' => 'Invalid filter parameters',
                    'code' => 400
                ],
                    400);
            }
            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'error' => $exception->getMessage(),
                    'code' => 401
                ],
                    401);
            }
        }
        return parent::render($request, $exception);

    }
}
