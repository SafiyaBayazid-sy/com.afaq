<?php
// app/Http/Middleware/CheckUserType.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle(Request $request, Closure $next, string $type)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        if ($request->user()->user_type !== $type) {
            return response()->json(['message' => 'Unauthorized - Invalid user type'], 403);
        }

        return $next($request);
    }
}