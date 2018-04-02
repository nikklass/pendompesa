<?php


View::share('passport_client_id', \Config::get('constants.passport.client_id'));
View::share('passport_client_secret', \Config::get('constants.passport.client_secret'));
View::share('passport_login_url', \Config::get('constants.passport.login_url'));
View::share('passport_user_url', \Config::get('constants.passport.user_url'));


View::share('get_users_url', \Config::get('constants.routes.get_users_url'));
View::share('send_message_url', \Config::get('constants.routes.send_message_url'));
View::share('create_user_url', \Config::get('constants.routes.create_user_url'));
View::share('create_message_url', \Config::get('constants.routes.create_message_url'));
View::share('fetch_savings_deposit_accounts_url', \Config::get('constants.routes.fetch_savings_deposit_accounts_url'));


//start clear caches

//Clear Cache facade value:
Route::get('/admin/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/admin/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/admin/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/admin/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/admin/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/admin/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//end clear caches


Route::get('/', 'HomeController@index')->name('home');

//Route::get('/admin', 'HomeController@index')->name('adminhome');



Route::group(['middleware' => 'auth'], function() {

	Route::get('/admin/home', 'Web\Admin\AdminHomeController@index')->name('adminhome');

	Route::post('logout', 'Auth\LoginController@logout')->name('logout'); 

	
	//export to excel data...
	Route::get('/admin/excel/export-smsoutbox/{type}', 'ExcelController@exportOutboxSmsToExcel')->name('excel.export-smsoutbox');
	Route::get('/admin/excel/export-groups/{type}', 'ExcelController@exportGroupsToExcel')->name('excel.export-groups');
	Route::get('/admin/excel/mpesa-incoming/{type}', 'ExcelController@exportMpesaIncomingToExcel')->name('excel.mpesa-incoming');
	Route::get('/admin/excel/yehu-deposits/{type}', 'ExcelController@exportYehuDepositsToExcel')->name('excel.yehu-deposits');
	Route::get('/admin/excel/ussd-registration/{type}', 'ExcelController@exportUssdRegistrationToExcel')->name('excel.ussd-registration');
	Route::get('/admin/excel/ussd-events/{type}', 'ExcelController@exportUssdEventsToExcel')->name('excel.ussd-events');
	Route::get('/admin/excel/ussd-payments/{type}', 'ExcelController@exportUssdPaymentsToExcel')->name('excel.ussd-payments');
	Route::get('/admin/excel/ussd-recommends/{type}', 'ExcelController@exportUssdRecommendsToExcel')->name('excel.ussd-recommends');
	Route::get('/admin/excel/ussd-contactus/{type}', 'ExcelController@exportUssdContactUsToExcel')->name('excel.ussd-contactus');
	Route::get('/admin/excel/loan-applications/{type}', 'ExcelController@exportLoanApplicationsToExcel')->name('excel.loan-applications');
	Route::get('/admin/excel/loans/{type}', 'ExcelController@exportLoanApplicationsToExcel')->name('excel.loans');
	
	Route::get('/admin/excel/prayer-requests/{type}', 'ExcelController@exportPrayerRequestsToExcel')->name('excel.prayer-requests');

	Route::get('/admin/excel/prayer-points/{type}', 'ExcelController@exportPrayerRequestsToExcel')->name('excel.prayer-points');

	Route::get('excel/user-logins/{type}', 'ExcelController@exportUserLoginsToExcel')->name('excel.user-logins');

	//handle bulk import user...
	Route::get('/admin/users/create-bulk', 'UserImportController@create')->name('bulk-users.create');
	Route::post('/admin/users/create-bulk', 'UserImportController@store')->name('bulk-users.store');
	Route::get('/admin/users/create-bulk/get-data/{uuid}', 'UserImportController@getImportData')->name('bulk-users.getimportdata');
	Route::get('/admin/users/create-bulk/get-incomplete/{uuid}', 'UserImportController@getIncompleteData')->name('bulk-users.getincompletedata');
	
	//send email routes...
	Route::get('/admin/email/newUser', 'EmailController@newUserEmail')->name('email.newuser');

	//user routes...
	Route::resource('/admin/users', 'Web\Users\UserController');

	//prayer requests routes... 
	Route::resource('/admin/prayer-requests', 'Web\PrayerRequest\PrayerRequestController');

	//prayer points routes... 
	Route::resource('/admin/prayer-points', 'Web\PrayerPoint\PrayerPointController');

	//global altars routes... 
	Route::resource('/admin/global-altars', 'Web\GlobalAltar\GlobalAltarController');

	//coordinators routes... 
	Route::resource('/admin/coordinators', 'Web\Coordinator\CoordinatorController');

	//state representatives routes... 
	Route::resource('/admin/state-representatives', 'Web\StateRepresentative\StateRepresentativeController');

	//leadership teams routes... 
	Route::resource('/admin/leadership-teams', 'Web\LeadershipTeam\LeadershipTeamController');

	//ebooks routes... 
	Route::resource('/admin/ebooks', 'Web\Ebook\EbookController');

	//quotes routes... 
	Route::resource('/admin/quotes', 'Web\Quote\QuoteController');

	//user profile routes...
	Route::get('/admin/profile/{id}', 'ProfileController@indexId')->name('user.profile.id');
	Route::get('/admin/profile', 'ProfileController@index')->name('user.profile'); 

	//image upload / resize routes
	Route::get('/admin/resizeImage', 'Web\Images\ImageController@resizeImage')->name('images.index');
	Route::post('/admin/resizeImagePost', 'Web\Images\ImageController@resizeImagePost')->name('images.store'); 

	//role routes...
	Route::resource('/admin/roles', 'RoleController', ['except' => 'destroy']);

	//group routes...
	Route::resource('/admin/groups', 'GroupController');

    //mpesa-incoming routes...
    Route::resource('/admin/mpesa-incoming', 'MpesaIncomingController');

    //ussd-registration routes...
    Route::resource('/admin/ussd-registration', 'Web\Ussd\UssdRegistrationController', ['except' => 'destroy']);

    //ussd-contactus routes...
    Route::resource('/admin/ussd-contactus', 'Web\Ussd\UssdContactUsController', ['except' => ['edit', 'update', 'destroy']]);

	//smsoutbox routes...
	Route::resource('/admin/smsoutbox', 'SmsOutboxController', ['except' => ['edit', 'destroy']]);

	//schedule smsoutbox routes...
	Route::resource('/admin/scheduled-smsoutbox', 'ScheduleSmsOutboxController');

});

//superadmin routes 
Route::group(['middleware' => 'role:superadministrator'], function() {
	
	//permission routes...
	Route::resource('/admin/permissions', 'PermissionController', ['except' => 'destroy']);

	//get user logins
	Route::get('/user-logins', 'Web\Admin\UserLoginController@index')->name('user-logins.index');
	Route::get('/user-logins/{id}', 'Web\Admin\UserLoginController@show')->name('user-logins.show');

});

//superadmin and admin routes
Route::group(['middleware' => 'role:superadministrator|administrator'], function() {
	//countries routes...
	Route::resource('/admin/countries', 'Web\Countries\CountriesController');
	//states routes...
	Route::resource('/admin/states', 'Web\States\StatesController');
});

Route::group(['middleware' => 'guest'], function() {

	//user login routes...
	Route::post('/users/user-logins', 'Web\Users\UserLoginController@store')->name('user-logins.store');

	// Authentication Routes...
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login')->name('login.store');

	Route::get('confirm', 'Auth\LoginController@showConfirmForm')->name('confirm');
	Route::post('confirm', 'Auth\LoginController@confirm')->name('confirm.store');

	Route::get('resend-code', 'Auth\LoginController@showResendCodeForm')->name('resend_code');
	Route::post('resend-code', 'Auth\LoginController@resendCode')->name('resend_code.store');

	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register')->name('register.store');

	// Password Reset Routes...
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.store');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

});
