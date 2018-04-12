<?php

namespace App\Http\Middleware;

use Closure;

class CheckFolderUid
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
        $folderUid = request()->segment(2);

        if ($folderUid && !auth()->user()->hasFolder($folderUid)) {
            return redirect(route('my-files'));
        }
        return $next($request);
    }
}
