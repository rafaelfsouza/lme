<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class RedirectBack
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (url()->previous() && $request->routeIs('*edit*', '*create*', '*show*')) {

            $route = app('router')->getRoutes()->match(request()->create(url()->previous()));

            if ($route) {
                if (!Str::is(['*edit*', '*create*', '*show*'], $route->getName())) {
                    redirect()->setIntendedUrl(url()->previous());
                }
            }
        }

        return $next($request);
    }
}
