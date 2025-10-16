<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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
        // Validating (422)
        if ($exception instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação.',
                'details' => $exception->errors(),
            ], 422);
        }

        // Not Found (404)
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => 'Recurso não encontrado.',
            ], 404);
        }

        // Not authenticated (401)
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'success' => false,
                'message' => 'Não autenticado.',
            ], 401);
        }

        // Generics Exceptions (403, 404, 500, etc)
        if ($exception instanceof HttpExceptionInterface) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage() ?: 'Erro HTTP.',
            ], $exception->getStatusCode());
        }

        // Exceptions
        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        }

        // Errors
        return response()->json([
            'success' => false,
            'message' => 'Erro interno no servidor.',
            'details' => config('app.debug')
                ? $exception->getMessage()
                : "Omitted (PRD Environment)",
        ], 500);
    }
}
