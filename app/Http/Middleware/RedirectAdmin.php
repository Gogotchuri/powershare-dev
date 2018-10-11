<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RedirectAdmin
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
        if (Auth::user()->is_admin) {
            //get route name
            $correspondingAdminRoute = str_replace('user.', 'admin.', Route::currentRouteName());

            if(Route::has($correspondingAdminRoute)) {
                return redirect(route($correspondingAdminRoute));
            }
        }

        return $next($request);
    }
}
