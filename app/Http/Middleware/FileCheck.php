<?php

namespace App\Http\Middleware;

use Closure;

class FileCheck
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
        $url = $request->segments();
        array_shift($url);

        return $next($request);
    }
}
