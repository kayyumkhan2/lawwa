<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Auth;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            if (Auth::check()) {
            if(Auth::user()->hasAnyRole('Customer','Beautician'))
              {
                $role = Auth::user()->roles->first()->name;
                  switch ($role) {
                    case 'Admin':
                    abort(404, 'Unauthorized action.');
                      break;
                    case 'Customer':
                      alert()->info('info','Access more services buy a membership plan')->autoclose(9000);
                      $membershippage = 'membership';
                      break; 
                    case 'Beautician':
                      alert()->info('info','Access more services buy a membership plan')->autoclose(9000);
                      $membershippage = 'membership';
                      break; 
                    default:
                    abort(404, 'Unauthorized action.');
                    break;
                 }
                return redirect($membershippage);
            }
          }
        }
        return parent::render($request, $exception);
    }
}
