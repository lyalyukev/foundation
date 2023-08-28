<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            throw new AuthenticationException('Unauthorized');
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $validToken = Token::where('token', $token)->first();

        if (!$validToken) {
            throw new AuthenticationException('Invalid token');
        }

        return $next($request);
    }
}
