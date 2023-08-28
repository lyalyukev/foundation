<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $validToken = Token::where('token', $token)->first();

        if (!$validToken) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
