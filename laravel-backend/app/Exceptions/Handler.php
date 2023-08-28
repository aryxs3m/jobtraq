<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        $this->reportable(function (\Throwable $e) {
        });

        $this->renderable(function (ValidationException $throwable, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'fail',
                    'data' => [
                        'message' => $throwable->getMessage(),
                    ],
                ], 200);
            }
        });

        $this->renderable(function (\Throwable $throwable, Request $request) {
            if ($request->is('api/*')) {
                $response = [
                    'status' => 'error',
                    'message' => $throwable->getMessage(),
                ];

                if (config('app.debug')) {
                    $response['data']['file'] = $throwable->getFile();
                    $response['data']['line'] = $throwable->getLine();
                }

                return response()->json($response, 200);
            }
        });
    }
}
