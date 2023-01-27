<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('beautician')->name('beautician.')->group(function() {
    Route::get('sign-up','BeauticianController@signup')->name("signup");
    Route::post('sign-up','BeauticianController@signuppost')->name("signuppost");
    Route::get('login','BeauticianController@login')->name("login");
    Route::post('login','BeauticianController@login')->name("loginpost");
    Route::get('reset-password','BeauticianController@resetpassword');
});

//After Login
Route::group(['prefix' => 'beautician', 'as' => 'beautician.', 'middleware' => ['Beautician','verified']], function () {
  //Dashboard
  Route::get('dashboard','DashboardController@index')->name("dashboard");
  Route::any('bookings/filter/{type}','DashboardController@Bookingfilter')->name("bookings.bookingfilter");
  
  //Myaccount
  Route::get('myaccount','BeauticianController@myaccount')->name("myaccount");
  Route::any('addAddress','BeauticianController@AddAddress')->name("AddAddress");
  Route::any('getAddress','BeauticianController@GetAddress')->name("GetAddress");
  Route::any('changepassword','BeauticianController@ChangePassword')->name("ChangePassword");
  Route::any('updateprofile','BeauticianController@UpdateProfileInformation')
        ->name("UpdateProfileInformation");
  Route::any('updateprofilepic','BeauticianController@UpdateProfilePic')->name("update_profile_pic");
   
  //GalleryImages
  Route::any('gallery_upload_image','BeauticianController@UploadGalleryImages')->name("gallery_upload_image");
  Route::get('gallery/loadimages','BeauticianController@loadimages');  
  Route::post('gallery/loadimages','BeauticianController@loadimagesAjax' );
  
  //BeauticianWorkingTime
  Route::resource('workingtime',BeauticianWorkingTimeController::class);
  
  //Notifications
  Route::any('notifications','NotificationController@index')->name('notifications.index');
  
  //Booking
  Route::any('bookings','BookingController@Booking')->name("Booking");
  Route::any('booking/details/{id}','BookingController@BookingDetails')->name("Booking.Details");
  Route::any('bookings/status/change/{id}','BookingController@BookingStatusChange')->name("bookings.bookingstatuschange");
  Route::get('bookings/temperature/upload/{id}','BookingController@BookingsTemperatureUpload')->name("bookings.temperature.upload");
  Route::any('bookings/cancel','BookingController@cancel')->name("bookings.cancel");

  
  //Temperature
  Route::post('bookings/temperature/upload','BookingController@BookingsTemperatureStore')->name("bookings.temperature.store");
  Route::post('bookings/temperature/upload/beautician','BookingController@BookingsTemperatureStoreBeautician')->name("bookings.temperature.store.beauticians");
  
  //BankDetail
  Route::resource('bankdetail','BankDetailController');
  
  //Wallet
  Route::any('wallet','WalletController@index')->name("wallet.index");
  
  //WorkHistory
  Route::any('work/history','WorkHistoryController@index')->name("workhistory.index");
  
  //Ticket
  Route::get('ticket/create', 'TicketsController@create')->name('ticket.create');
  Route::post('tickets/store', 'TicketsController@store')->name('ticket.store');
  Route::any('tickets', 'TicketsController@index')->name('ticket.index');
  Route::get('tickets/{ticket_id}', 'TicketsController@show')->name('ticket.show');
  Route::post('close_ticket/{ticket_id}', 'TicketsController@close')->name('ticket.close_ticket');
  Route::post('tickets/comment', 'CommentsController@postComment')->name('ticket.comment');
   
  //Video Recodings
  Route::resource('videos', 'VideoRecodingController');

  //Ratings
  Route::resource('ratings',UserRatingController::class);
  //Feedback
  Route::get('feedback', 'FeedbackController@create')->name('feedback.create');
  Route::post('feedback/store', 'FeedbackController@store')->name('feedback.store'); 
  
});
