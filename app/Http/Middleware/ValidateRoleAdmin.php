<?php

namespace App\Http\Middleware;

use Closure;

class ValidateRoleAdmin
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
            if (!in_array("admin", $request->header('roles'))) {
                return response()->json(['unauthorized', 401]);
            }
            return $next($request);
            
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage(), 401]);
        }
    }
}
