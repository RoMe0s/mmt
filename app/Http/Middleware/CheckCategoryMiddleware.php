<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;

class CheckCategoryMiddleware
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

        if(Category::where("id", $request->route("category_id"))->exists()) {

            return $next($request);

        }

        abort(404);

    }

}
