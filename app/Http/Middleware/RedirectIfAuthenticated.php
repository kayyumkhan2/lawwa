<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
        $role = Auth::user()->roles->first()->name;
          switch ($role) {
            case 'Admin':
              $HOME = 'admin/dashboard';
              break;
            case 'Customer':
              $HOME = 'myaccount';
              break; 
            case 'Beautician':
              $HOME = 'beautician/myaccount';
              break; 
            default:
              $HOME = 'admin/dashboard';
            break;
             }
          return redirect()->intended($HOME);
        }
    }
        return $next($request);
    }
}
