<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();

        if (Auth::user()) {
            foreach (Auth::user()->role->permissions as $permission) {
                if ($routeName == $permission->route) {
                    return $next($request);
                }

                if (str_ends_with($permission->route, '.*')) {
                    $permissionPrefix = rtrim($permission->route, '.*'); // Remove the trailing ".*"
                    if (str_starts_with($routeName, $permissionPrefix)) {
                        return $next($request);
                    }
                }
            }
            return response()->json(['status' => 'error', 'message' => 'თქვენ არ გაქვთ წვდომა']);
        } else {
            return $next($request);
        }
    }
}