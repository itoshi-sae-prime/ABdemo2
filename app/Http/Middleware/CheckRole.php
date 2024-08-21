<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('user')) {
            return redirect()->route('loginview');
        }

        // Retrieve the user's role from the session
        $userRole = session('user')->Role;

        // Check if the user has the required role
        if ($userRole !== $role) {
            return redirect()->route('loginview')->withErrors([
                'error' => 'Unauthorized access. Please log in with the correct account.'
            ]);
        }

        return $next($request);
    }
}
