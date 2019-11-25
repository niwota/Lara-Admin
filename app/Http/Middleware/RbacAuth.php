<?php

namespace App\Http\Middleware;

use Closure;

class RbacAuth
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
        $user = auth()->user();
        $action = $request->route()->action;
        if($user->can($action['as']??''))
            return $next($request);
        return abort(403);
    }
}
