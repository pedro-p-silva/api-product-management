<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JsonResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $status = $response->getStatusCode();
            $original = $response->getData(true);

            if (is_array($original) && array_key_exists('success', $original)) {
                return $response;
            }

            if (!is_array($original)) {
                $actionRequest = $this->defineActionRequest($request);
                $original = [$actionRequest => $original];
            }


            if ($status >= 400) {
                $message = $original['message'] ?? $this->defaultMessage($status);

                $formatted = [
                    'message' => $message,
                    'success' => false,
                ];

                if (isset($original['errors'])) {
                    $formatted['errors'] = $original['errors'];
                }

                $response->setData($formatted);
            }
            else {
                $response->setData([
                    'data' => $original,
                    'success' => true,
                ]);
            }
        }

        return $response;
    }

    protected function defaultMessage(int $status): string
    {
        return match ($status) {
            400 => 'Invalid request.',
            401 => 'Unauthorized.',
            403 => 'Access denied.',
            404 => 'Resource not found.',
            422 => 'Validation error.',
            500 => 'Internal server error.',
            default => 'An unexpected error occurred.',
        };
    }

    protected function defineActionRequest($request): string
    {
        return match ($request->getMethod()) {
            'PUT' => "updated",
            'DELETE' => "deleted",
            default => "action",
        };
    }
}
