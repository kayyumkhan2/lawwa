<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Providers\RouteServiceProvider;

class Customer
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            if (Auth::user()->roles->first()=='') {
                Auth::logout();
                return redirect('/');
              }
             if(Auth::user()->roles->first()->name=="Customer"){
                return $next($request);
              }
            else{
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
        }
        
    }
}
