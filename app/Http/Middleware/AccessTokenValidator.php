<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;

class AccessTokenValidator
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
        if($request->method() == 'POST' && ($request->is('*/users') || $request->is('*/users/login'))) {
            return $next($request);
        }
        try {
            $key = config('services.oauth_server.key');
            $token = $request->header('access_token');
            $decoded = JWT::decode($token, $key, array('HS256'));
            $request->headers->set('user_id', $decoded->sub);
            return $next($request);
            
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage(), 401]);
        }
    }
}
