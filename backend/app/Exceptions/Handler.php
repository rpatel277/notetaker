<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    /**
     * Custom Exception Handler
     *
     * This method overrides the default rendering behavior for specific exceptions.
     * When encountering a ModelNotFoundException and the request expects a JSON response,
     * it provides a clear JSON message stating 'Resource not found' with a 404 status code.
     * Otherwise, it delegates to the parent class for standard exception handling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // This will replace our 404 response with
        // a JSON response.
        if (
            $exception instanceof ModelNotFoundException &&
            $request->wantsJson()
        ) {
            return response()->json([
                'data' => 'Resource not found'
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
