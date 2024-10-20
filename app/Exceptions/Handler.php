<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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

    public function render($_request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            $message = $exception->getMessage();  // Use the default validation message
            return ResponseHelper::error($message, 422);
        }

        $message = $exception->getMessage() ?: 'An unexpected error occurred';
        $statusCode = $exception->getCode() ?: 500;

        return ResponseHelper::error($message, $statusCode);
    }
}
