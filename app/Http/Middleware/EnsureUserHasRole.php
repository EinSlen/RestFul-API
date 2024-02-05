<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole {
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response {
        if ($request->user()->roles()->where('nom', Role::ADMIN)->exists())
            return $next($request);

        if ($request->user()->roles()->where('nom', $role)->exists())
            return $next($request);

        throw new HttpResponseException(response()->json(json_encode([
            'message' => "The user {$request->user()->name} can't access to this endpoint"]),
            RESPONSE::HTTP_FORBIDDEN));
    }
}
