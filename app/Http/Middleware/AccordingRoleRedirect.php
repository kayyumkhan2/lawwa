<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
use App\Providers\RouteServiceProvider;
class AccordingRoleRedirect
{
    public function handle($request, Closure $next)
    {
      if (Auth::user()->roles->first()=='') {
            Auth::logout();
            return redirect('/');
          }
      if(Auth::user()->hasAnyRole('Customer','Beautician'))
      {
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
        return redirect($HOME);
      }
        return $next($request);
    }
}
