<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            Log::info("User role: {$userRole}, Required roles: " . implode(',', $roles));

            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        Log::warning('Access denied: User does not have the required role.');

        return redirect()->route('home')->with('error', 'Access denied.');
    }
}
