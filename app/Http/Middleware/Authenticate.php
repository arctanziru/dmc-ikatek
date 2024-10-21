<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Return null if the request expects JSON (for API requests)
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an unauthenticated user.
     */
    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            // Return JSON response for unauthenticated API requests
            abort(response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401));
        }

        parent::unauthenticated($request, $guards);
    }
}
