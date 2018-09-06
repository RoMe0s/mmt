<?php

namespace App\Http\Middleware;

use Closure;

class AjaxMiddleware
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

        if($request->expectsJson()) {

            return $next($request);

        }

        abort(403);

    }

}
