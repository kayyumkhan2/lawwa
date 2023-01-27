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


    Route::get('/', 'FrontController@index')->name('front.home');
    //Services
    Route::get('servicescategory', 'ServiceController@servicescategory')->name("services.servicescategory");
    Route::get('services-subcategory/{id}', 'ServiceController@servicessubcategory')->name("services.servicessubcategory");
    Route::get('services/{id}', 'ServiceController@services')->name("services");

    //Products
    Route::get('productcategory', 'ProductController@productscategory')->name("products.productscategory");
    Route::any('products-listing/{id}', 'ProductController@productslisting')->name("products.productslisting");
    Route::get('products/{id}', 'ProductController@products')->name("products");
    Route::get('product-details/{id}', 'ProductController@productdetails')->name("product-details");
    
	// PostContact us form data
    Route::post('contact', [
        'uses' => 'QueryManagementController@ContactUsForm',
        'as' => 'contact.store'
    ]);

    //PostSupport form data
    Route::post('support', [
        'uses' => 'QueryManagementController@SupportForm',
        'as' => 'support.store'
    ]);
    
    //Pages
    Route::get('about-us','PageController@aboutus')->name('pages.about-us');  
    Route::get('academy','PageController@academy')->name('pages.academy');  
    Route::get('course/details','PageController@coursedetails')->name('pages.course-details');  
    Route::get('certificate/details','PageController@certificatedetails')->name('pages.certificate-details');  
    Route::get('news/details','PageController@newsdetails')->name('pages.news-details');  
    Route::get('academy-facilities/details','PageController@academyfacilitiesdetails')->name('pages.academy-facilities-details'); 
    Route::get('contact-us','PageController@contactus')->name('pages.contact-us');
    Route::get('faq','PageController@faq')->name('pages.faq');  
    Route::get('privacy-policy','PageController@privacypolicy')->name('pages.privacy-policy');
    Route::get('gallery','PageController@gallery')->name('pages.gallery'); 
    Route::get('terms-condition','PageController@termscondition')->name('pages.terms-condition'); 
    Route::get('membership','PageController@membership')->name('pages.membership');  
    Route::get('support','PageController@support')->name('pages.support');
    
    //Recruitments
    Route::get('recruitments','PageController@recruitments')->name('pages.recruitments'); 
    Route::get('recruitments/details','PageController@recruitmentsdetails')->name('pages.recruitments-details');
    Route::get('recruitment/apply/{id}','RecruitmentApplyController@create')->name('pages.recruitmentapply.create'); 
    Route::post('recruitments/apply/store','RecruitmentApplyController@store')->name('pages.recruitmentapply.store');   

    Route::group(['middleware' => ['auth','Beautician']], function () {
    //CoursePayemnt
    Route::get('course/payment','PaymentController@CoursePayment');
    Route::get('course/payment/success/{id}','PaymentController@CoursePaymentSuccess')
            ->name('course.payment.success');  
    Route::get('course/payment/fail/{id}','PaymentController@CoursePaymentFail')->name('course.payment.fail');
    //CertificateStore
    Route::post('certificate/plan','CertificateController@store')->name('selected.certificates.plans');  
    
    //CoursePayemntStore
    Route::post('course/plan','CourseController@store')->name('selected.course.plans');

});  
    
    Route::group(['middleware' => ['auth', 'Customer','verified']], function () {
    //Serices cart
    Route::get('service/add/{service_id}', 'ServiceCartController@addservicecarttocart')->name("addservicecarttocart");
    Route::get('service/remove/{service_id}', 'ServiceCartController@removeservicecarttocart')
         ->name("removeservicecarttocart");
    Route::get('service/emptycart', 'ServiceCartController@emptycart')->name("emptycart");
    
    //Product cart
    Route::get('product/showcart', 'ProductCartController@showcart')->name("showcart");
    Route::get('product/GetProductCart', 'ProductCartController@GetProductCart')->name("GetProductCart");
    Route::get('Get/Product/Cart/Count', 'ProductCartController@GetProductCartCount')->name("GetProductCartCount");
    Route::any('Add/To/Product/Cart', 'ProductCartController@AddToCartProduct')->name("AddToCartProduct");
    Route::any('Remove/Item/To/ProductCart', 'ProductCartController@RemoveItemToProductCart')
           ->name("RemoveItemToProductCart");
    Route::get('Empty/productcart', 'ProductCartController@emptyproductcart')->name("emptyproductcart");

    //ProductCartCheckout
    Route::get('product/cart/checkout', 'ProductCartController@Checkout')->name("cart.Checkout");
    Route::post('Product/chheckout/store', 'ProductCartController@CheckoutStore')->name("cart.CheckoutStore");
    Route::get('product/checkout/cart', 'ProductCartController@CheckOutCart')->name("CheckOutCart");
    Route::get('product/get/user/address', 'ProductCartController@GetUserAddress')->name("GetUserAddress");


   //Book-services
    Route::get('service/book', 'BookingController@create')->name("booking.create");
    Route::post('service/book', 'BookingController@store')->name("booking.store");
    Route::any('finduser','BookingController@finduser')->name('booking.finduser');

    //OrderPayment
    Route::get('payment','PaymentController@Payment');
    Route::get('payment/success/{id}','PaymentController@PaymentSuccess')->name('payment.success');  
    Route::get('payment/fail/{id}','PaymentController@PaymentFail')->name('payment.fail'); 
    
    //BookingPayment
    Route::get('booking/payment','PaymentController@BookingPayment');
    Route::get('booking/payment/success/{id}','PaymentController@BookingPaymentSuccess')
            ->name('Booking.payment.success');  
    Route::get('booking/payment/fail/{id}','PaymentController@BookingPaymentFail')->name('Booking.payment.fail');
   
    //SubscriptionPayemnt
    Route::get('membership/payment','PaymentController@MembershipPayment');
    Route::get('membership/payment/success/{id}','PaymentController@MembershipPaymentSuccess')
            ->name('membership.payment.success');  
    Route::get('membership/payment/fail/{id}','PaymentController@MembershipPaymentFail')->name('membership.payment.fail');

    //SubscriptionPayemntStore
    Route::post('membership/plan','MembershipPlanController@store')->name('selected.subscription.plans');

});



