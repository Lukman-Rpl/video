<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken(); // Ambil token dari Authorization: Bearer <token>

        if (!$token) {
            return response()->json(['message' => 'Token tidak ditemukan'], 401);
        }

        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token tidak valid'], 401);
        }

        // Bisa digunakan nanti untuk kebutuhan user login:
        // $request->merge(['user' => $user]);

        return $next($request);
    }
}
