<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UniversalController;
use App\Http\Controllers\Auth\LoginController;
use Laravel\Socialite\Facades\Socialite;

Route::get('auth/social',[LoginController::class,'show'])->name('social.login');
Route::get('oauth/{driver}/Customer',[LoginController::class,'redirectToProvider'])->name('Customer.social.oauth');
//Comman for customer And Beautician
Route::get('oauth/{driver}/callback',[LoginController::class,'handleProviderCallback'])->name('social.callback');
//Social Login for Beautician
Route::get('auth/social',[LoginController::class,'show'])->name('social.login');
Route::get('oauth/{driver}/Beautician',[LoginController::class,'redirectToProvider'])->name('Beautician.social.oauth');
// Clear Cammand Cache
Route::get('/sab-clear', function() {
	Artisan::call('route:clear');
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	Artisan::call('migrate');			
	return "Sab-clear ho Gya";
});
//social Test
Route::get('/sociallogin', function () {
    return view('welcome');
});
//social Test
Route::get('testpage', function () {
    return view('testpage');
});
//coursestest
Route::get('coursestestpage', function () {
    return view('coursestestpage');
});
//coursestest
Route::any('get-states-by-country',[UniversalController::class,'getState'])->name('get-states-by-country');
Route::any('get-cities-by-state',[UniversalController::class,'getCity'])->name('get-cities-by-state');

Route::group(['middleware' => ['auth']], 
function(){	
Route::any('universalstatuschange',[UniversalController::class,'universalstatuschange'])->name('universalstatuschange');
Route::any('universaldelete',[UniversalController::class,'universaldelete'])->name('universaldelete');	 
});








//Auth Routes
require __DIR__.'/auth.php';

