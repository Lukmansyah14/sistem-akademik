<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Lamun acan login, atawa role user teu kaasup dina daptar role nu diidinan
        if (!auth()->check() || !in_array($request->user()->role, $roles)) {
            // Mentalkeun sarta bikeun kode error 403 (Forbidden)
            abort(403, 'Maaf, bukan Hak Akses Anda!');
        }

        return $next($request);
    }
}
