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
//Before Login
Route::prefix('customer')->name('customer.')->group(function() {
    Route::get('sign-up','CustomerController@signup')->name("signup");
    Route::post('sign-up','CustomerController@signuppost')->name("signuppost");
    Route::get('login','CustomerController@login')->name("login");
    Route::post('login','CustomerController@login')->name("loginpost");
    Route::get('reset-password','CustomerController@resetpassword');
});

//After Login
Route::group(['prefix' => 'myaccount', 'as' => 'customer.', 'middleware' => ['auth','Customer','verified']], function () {
  //Dashboard
  Route::get('dashboard','DashboardController@index')->name("dashboard");
  Route::any('bookings/filter/{type}','DashboardController@Bookingfilter')->name("bookings.bookingfilter");

  //My Account
  Route::get('','CustomerController@myaccount')->name("myaccount");
  Route::any('addAddress','CustomerController@AddAddress')->name("AddAddress");
  Route::any('getAddress','CustomerController@GetAddress')->name("GetAddress");
  Route::any('changepassword','CustomerController@ChangePassword')->name("ChangePassword");
  Route::any('updateprofile','CustomerController@UpdateProfileInformation')->name("UpdateProfileInformation");
  Route::any('updateprofilepic','CustomerController@UpdateProfilePic')->name("UpdateProfilePic");
  
  //Health Conditions  
  Route::get('healthconditions/create','HealthConditionController@create')->name("health.condition.create");
  Route::post('healthconditions/store','HealthConditionController@store')->name("health.condition.store");

  //Booking
  Route::any('bookings','BookingController@Booking')->name("Booking");
  Route::any('booking/details/{id}','BookingController@BookingDetails')->name("Booking.Details");
  Route::any('booking/start/{booking_id}/{assign_beautician_id}','BookingController@BookingStart')->name("Booking.Start");
  Route::any('bookings/cancel/request','BookingController@cancel')->name("bookings.cancel");
  Route::any('bookings/postpone/request','BookingController@postpone')->name("bookings.postpone");

  //Orders
  Route::any('orders','OrderController@orders')->name("orders");
  Route::any('orders/details/{order_id}','OrderController@orderdetails')->name("order.details");
  Route::any('order/cancel','OrderController@cancel')->name("order.cancel");

  //My-favourite
  route::any('my-favourite','MyFavouriteController@index')->name('my-favourite.index');
  route::any('my-favourite/addtomyfavourite/{product_id}','MyFavouriteController@addtomyfavourite')->name('my-favourite.addtomyfavourite');
  route::any('my-favourite/remove/{product_id}','MyFavouriteController@RemoveFavourite')
        ->name('my-favourite.removefavourite');  

  //Notifications
  route::any('notifications','NotificationController@index')->name('notifications.index');
  //Assigned-beautician-profile
  route::any('assigned-beautician-profile/{booking_id}','AssignedBeauticianProfile@index')->name('assignedbeauticianprofile.index');
  
  //Ticket
  Route::get('tickets/create', 'TicketsController@create')->name('ticket.create');
  Route::post('tickets/store', 'TicketsController@store')->name('ticket.store');
  Route::any('tickets', 'TicketsController@index')->name('ticket.index');
  Route::get('tickets/{ticket_id}', 'TicketsController@show')->name('ticket.show');
  Route::post('close_ticket/{ticket_id}', 'TicketsController@close')->name('ticket.close_ticket');
  Route::post('tickets/comment', 'CommentsController@postComment')->name('ticket.comment');
  Route::any('tickets/comments/getcomments', 'CommentsController@GetComments')->name('ticket.getcomments');

  //Ratings
  Route::resource('ratings',UserRatingController::class);

  //Feedback
  Route::get('feedback', 'FeedbackController@create')->name('feedback.create');
  Route::post('feedback/store', 'FeedbackController@store')->name('feedback.store');

  //Membership
  Route::get('membership', 'MembershipUserController@index')->name('membership.index');
  Route::get('membership/info', 'MembershipUserController@show')->name('membership.show');

  //ProductsRatings
  Route::get('product/rating/create','ProductReviewRatingController@create')->name('product.rating.create');
  Route::post('product/rating/post','ProductReviewRatingController@store')->name('product.rating.store');
  

});
