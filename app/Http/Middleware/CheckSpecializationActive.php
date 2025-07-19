<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSpecializationActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }
        if ($request->routeIs('dashboard.reviewers.index')) {
            return $next($request);
        }
        if (!$user || $user->specialization_id === null || !$user->specialization->is_active) {
            abort(403, 'تخصصك غير مفعل حاليًا.');
        }
        return $next($request);
    }
}
