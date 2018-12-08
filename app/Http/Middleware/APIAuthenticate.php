<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class APIAuthenticate
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
        if (!Auth::check()) {
            return response()->json([
                'msg' => trans('messages.access_denied'),
            ], 403);
        }


        return $next($request);
    }
}
