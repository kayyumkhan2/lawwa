<?php 
use App\Http\Controllers\UniversalController;
Route::group(['prefix' => 'admin', 'middleware' => ['auth','AccordingRoleRedirect']], function()
{  
    //Dashboard       
    Route::get('dashboard','HomeController@index')->name('admin.dashboard');
    //User Management     
    Route::resource('users',UserController::class);
    Route::get('ChangePassword/{id}', 'UserController@changepasswordview')->name('changepasswordview');
    Route::post('ChangePassword/{id}','UserController@changepassword')->name('ChangePassword');
    //Admin manager
    Route::get('managers','UserController@index')->name('users.admin.managers');
    Route::get('create/manager','UserController@create')->name('admin.create.manager');
    Route::get('manager/profile/{user_id}','UserController@adminmanagerprofile')->name('users.adminmanagerprofile');
    Route::get('manager/profile/edit/{user_id}','UserController@edit')->name('users.adminmanagerprofileedit');
    //Beauticians
    Route::get('users/create/beautician','UserController@create')->name('users.createbeautician');
    Route::get('users/all/beauticians','UserController@index')->name('users.beauticians');
    Route::get('users/beautician/profile/{id}','UserController@beauticianprofile')->name('users.beauticianprofile');
    //Customers
    Route::get('users/all/customers','UserController@index')->name('users.customers');
    Route::get('users/create/customer','UserController@create')->name('users.createcustomer');
    Route::get('users/membership/customer','UserController@index')->name('users.membershipcustomers');
    Route::get('users/healthconditions/form/download/{user_id}','UserController@HealthConditionsFormDownload')->name('users.healthconditionsform');

    //Service
    Route::resource('service',ServiceController::class);
    Route::get('services/category-service/{id}','ServiceController@categoryservice')->name('services.categoryservice');
    //Categories
    Route::resource('categories',CategoryController::class);
    Route::post('edit-category','CategoryController@edit_category')->name('edit_category');
    //Service Categories
    Route::get('categories/service/category','CategoryController@index')->name('categories.servicecategories');
    Route::get('categories/servicecategory/create','CategoryController@create')->name('categories.create.servicecategory');
    Route::post('service/subcategory','CategoryController@servicesubcategory')->name('categories.servicesubcategory');
    //Product offer Categories
    Route::any('products/offres/category','CategoryController@index')->name('categories.productsoffrescategory');
    //Products
    Route::resource('products','ProductController');
    Route::get('products/category-products/{id}','ProductController@categoryproducts')->name('products.categoryproducts');
    Route::get('productimagedelete', 'ProductController@productimagedelete')->name('products.productimagedelete');

    //Brands
    Route::resource('brands',BrandController::class);
    //Mail Templates
    Route::resource('mailtemplates',MailTemplateController::class);
    //Social Links
    Route::resource('sociallinks',SocialLinkController::class);
     //Notifications
    Route::resource('notifications',NotificationController::class);
    Route::any('notificationsalstatuschange',[UniversalController::class,'notificationsalstatuschange'])->name('notificationsalstatuschange');
    Route::get('notifications/send/beauticians','NotificationController@create')->name('notifications.send.beauticians');
    Route::get('notifications/send/customers','NotificationController@create')->name('notifications.send.customers');
    //Roles
    Route::resource('Roles', RoleController::class);
    Route::resource('Permissions', PermissionController::class);
    //Banners
    Route::resource('banners','BannerController');
    //settings
    Route::get('settings','SettingController@index')->name('settings.index');
    Route::get('settings/create','SettingController@create')->name('settings.create');
    Route::get('settings/contactussettings','SettingController@contactussettings')->name('settings.contactussettings');
    Route::get('settings/edit/{id}','SettingController@edit')->name('settings.edit');
    Route::any('settings/update/{id}','SettingController@update')->name('settings.update');

    //Contactussettings
    //address
    Route::get('settings/address/{id?}','SettingController@index')->name('settings.contactussettings.address');
    Route::post('settings/address/{id?}','SettingController@Addressstore')
           ->name('settings.contactussettings.address.store');
    //Email
    Route::get('settings/email/{id?}','SettingController@index')->name('settings.contactussettings.email');
    Route::post('settings/email/{id?}','SettingController@Emailstore')
           ->name('settings.contactussettings.email.store');
    //ContactNumber 
    Route::get('settings/contactnumber/{id?}','SettingController@index')->name('settings.contactussettings.contactnumber');
    Route::post('settings/contactnumber/{id?}','SettingController@Contactnumberstore')->name('settings.contactussettings.contactnumber.store');
    //BankNames 
    Route::get('settings/bank/{id?}','SettingController@index')->name('settings.bank.index');
    Route::post('settings/bank/{id?}','SettingController@BankNamestore')->name('settings.bank.store');
    //Homecontent
    Route::get('settings/homepagecontent/{id?}','SettingController@index')->name('settings.homepagecontent');
    Route::post('settings/homepagecontent/{id?}','SettingController@Homepagecontentstore')
           ->name('settings.homepagecontent.store');
    //QueryManagementController
    Route::resource('queries','QueryManagementController');
    //Orders        
    Route::resource('orders','OrderController');
    Route::any('order/data/filter','OrderController@orderdatefilter')->name('orderdatefilter');
    Route::any('order/Download/invoice/{id}','OrderController@Downloadinvoice')->name('order.downloadinvoice');
    Route::any('order/data/statuschange','OrderController@StatusChange')->name('statuschange');
    Route::any('order/tracking-id-update','OrderController@trakingIdUpdate')->name('order-tracking-id-update');
    //Bookings        
    Route::resource('bookings','BookingController');
    Route::any('bookings/data/filter','BookingController@Bookingdatefilter')->name('bookings.bookingdatefilter');
    Route::get('bookings/booking/assign/{id}','BookingController@bookingassign')->name('bookings.booking.assign');
    Route::any('bookings/Download/invoice/{id}','BookingController@Downloadinvoice')->name('bookings.downloadinvoice');
    Route::post('bookings/booking/assign/{id}/beautician','BookingController@bookingassigntobeautician')
           ->name('bookings.booking.assign.tobeautician');
    //Pages
    //About us
    Route::post('about-us','PageController@Aboutusupdate')->name('admin.pages.about-us.update');
    //Privacy-Policy
    Route::post('privacy-policy','PageController@PrivacyPolicyUpdate')->name('admin.pages.privacy-policy-update');
    //Academy
    Route::post('academy','PageController@Academy')->name('admin.pages.academy-update');
    Route::post('page/update/academy/courses','PageController@AcademyCoursesUpdateStore')
                ->name('admin.page.academy.courses'); 
    Route::post('page/update/academy/certificates','PageController@AcademyCertificatesUpdateStore')
                ->name('admin.page.academy.certificates'); 
    Route::post('page/update/academy/facilities','PageController@AcademyFacilitiesUpdateStore')
                ->name('admin.page.academy.faculty');
    #Show All pages List
    Route::get('pages','PageController@index')->name('admin.pages');
    #Show Single page data
    Route::get('page/update/{pagename}','PageController@update')->name('admin.page.update');

    //Recruitments
    Route::any('page/update/recruitments/{id?}','PageController@RecruitmentsUpdateStore')
                ->name('admin.page.recruitments'); 
    //Gallery
    Route::get('page/update/gallery/{pagename?}/{id?}','PageController@gallery')->name('admin.page.gallery.pages');
    Route::any('pages/gallery-news/{id?}','PageController@GalleryNewsUpdateStore')
            ->name('admin.pages.gallery.gallery-news.update');
    Route::any('pages/gallery-photos/{id?}','PageController@GalleryPhotosUpdateStore')
            ->name('admin.pages.gallery.gallery-photos.update');
    Route::any('pages/gallery-videos/{id?}','PageController@GalleryVideosUpdateStore')
            ->name('admin.pages.gallery.gallery-videos.update');
    //Subscriptionplan
    Route::resource('membershipplan','MembershipPlanController');
          
    //FaqQuestions
    Route::get('pages/faq-questions/{id?}','PageController@FaqQuestions')->name('admin.pages.faq-questions');
    Route::post('pages/faq-questions/{id?}','PageController@FaqQuestionsUpdateStore')->name('admin.pages.faq-questions.update');

    //FaqQuestions
    Route::get('pages/terms-condition/{id?}','PageController@TermsCondition')->name('admin.pages.terms-condition');
    Route::post('pages/terms-condition/{id?}','PageController@TermsConditionUpdateStore')->name('admin.pages.terms-condition.update');
    
    //Tickets
    Route::get('tickets', 'TicketsController@index')->name('admin.tickets.index');
    Route::post('close_ticket/{ticket_id}', 'TicketsController@close')->name('admin.ticket.close_ticket');
    Route::get('tickets/{ticket_id}', 'TicketsController@show')->name('admin.tickets.show');
    Route::post('tickets/comment', 'CommentsController@postComment')->name('admin.ticket.comment');

    //QueryManagementController
    Route::resource('feedbacks','FeedbackController');
    Route::resource('Queries','QueryManagementController');
    Route::resource('recruitmentapplies','RecruitmentApplyController');
    Route::any('Queries/changeStatus','QueryManagementController@changeStatus')->name('queries.changestatus');;

    //Payments
    Route::get('payments','PaymentController@index')->name('payments');
    Route::any('payments/data/filter','PaymentController@paymentatefilter')->name('paymentatefilter');

    //Certificates
    Route::any('certificates','CertificateController@index')->name('certificates.index');
    Route::any('certificates/updatestatus','CertificateController@updatestatus')->name('certificates.updatestatus');
   
    Route::any('courses','CourseController@index')->name('courses.index');
    // Business Times
    Route::resource('businesstimes', 'BusinessTimeController', [
    'except' => [
        'create'
    ]
]);

  });
