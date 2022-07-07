<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Enums\StatusCode;

class JwtVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json([], StatusCode::UNAUTHORIZED);
            }
        } catch (\Throwable $e) {
            return response()->json(['code' => StatusCode::UNAUTHORIZED, 'status' => 'Authorization Token not found'], StatusCode::UNAUTHORIZED);
        }
        return $next($request);
    }
}
