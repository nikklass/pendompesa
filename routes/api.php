<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){

    $api->group(['middleware' => ['throttle:60,1', 'bindings'], 'namespace' => 'App\Http\Controllers'], function($api) {

        $api->get('ping', 'Api\PingController@index');

        //login and refresh token
        $api->post('/login', 'Api\Users\ApiLoginController@login');

        //mpesa initiate
        $api->group(['prefix' => 'mpesa'], function ($api) {
            $api->post('/onlinepayment', 'Api\Mpesa\ApiMpesaOnlineController@store');
        });

        //mpesa callbacks
        $api->group(['prefix' => 'mpesa-callback'], function ($api) {
            $api->post('/onlinepayment', 'Api\Mpesa\ApiMpesaOnlineCallbackController@store');
        });

        //countries
        $api->group(['prefix' => 'countries'], function ($api) {
            $api->get('/', 'Api\Countries\ApiCountriesController@index');
            $api->get('/{id}', 'Api\Countries\ApiCountriesController@show');
        });

        //states
        $api->group(['prefix' => 'states'], function ($api) {
            $api->get('/', 'Api\States\ApiStatesController@index');
            $api->get('/{id}', 'Api\States\ApiStatesController@show');
        });

        //cities
        $api->group(['prefix' => 'cities'], function ($api) {
            $api->get('/', 'Api\Cities\ApiCitiesController@index');
            $api->get('/{id}', 'Api\Cities\ApiCitiesController@show');
        });

        //ussd registration routes
        $api->group(['prefix' => 'ussd-registration'],function ($api) {
            $api->post('/', 'Api\Ussd\ApiUssdRegistrationController@store');
            $api->get('/', 'Api\Ussd\ApiUssdRegistrationController@index');
            $api->get('/confirm', 'Api\Ussd\ApiUssdRegistrationController@confirm');
            $api->get('/{id}', 'Api\Ussd\ApiUssdRegistrationController@show');
            $api->put('/{id}', 'Api\Ussd\ApiUssdRegistrationController@update');
            $api->patch('/{id}', 'Api\Ussd\ApiUssdRegistrationController@update');
        });

        //ussd payment routes
        $api->group(['prefix' => 'ussd-payments'],function ($api) {
            $api->post('/', 'Api\Ussd\ApiUssdPaymentController@store');
            $api->get('/', 'Api\Ussd\ApiUssdPaymentController@index');
            $api->get('/{id}', 'Api\Ussd\ApiUssdPaymentController@show');
            $api->put('/{id}', 'Api\Ussd\ApiUssdPaymentController@update');
            $api->patch('/{id}', 'Api\Ussd\ApiUssdPaymentController@update');
        });

        //ussd events routes
        $api->group(['prefix' => 'ussd-events'],function ($api) {
            $api->post('/', 'Api\Ussd\ApiUssdEventController@store');
            $api->get('/', 'Api\Ussd\ApiUssdEventController@index');
            $api->get('/{id}', 'Api\Ussd\ApiUssdEventController@show');
            $api->put('/{id}', 'Api\Ussd\ApiUssdEventController@update');
            $api->patch('/{id}', 'Api\Ussd\ApiUssdEventController@update');
        });

        //ussd contact us routes
        $api->group(['prefix' => 'ussd-contact-us'],function ($api) {
            $api->post('/', 'Api\Ussd\ApiUssdContactUsController@store');
            $api->get('/', 'Api\Ussd\ApiUssdContactUsController@index');
            $api->get('/{id}', 'Api\Ussd\ApiUssdContactUsController@show');
            $api->put('/{id}', 'Api\Ussd\ApiUssdContactUsController@update');
            $api->patch('/{id}', 'Api\Ussd\ApiUssdContactUsController@update');
        });

        //ussd recommend routes
        $api->group(['prefix' => 'ussd-recommend'],function ($api) {
            $api->post('/', 'Api\Ussd\ApiUssdRecommendController@store');
            $api->get('/', 'Api\Ussd\ApiUssdRecommendController@index');
            $api->get('/{id}', 'Api\Ussd\ApiUssdRecommendController@show');
            $api->put('/{id}', 'Api\Ussd\ApiUssdRecommendController@update');
            $api->patch('/{id}', 'Api\Ussd\ApiUssdRecommendController@update');
        });

        //mpesa-incoming routes...
        //Route::resource('ussd-events', 'Api\Ussd\ApiUssdEventController');

        //create user
        $api->group(['prefix' => 'users'], function ($api) {
            $api->post('/', 'Api\Users\ApiUsersController@store');
            $api->post('/confirm', 'Api\Users\ApiUsersController@accountconfirm');
        });

        $api->group(['prefix' => 'groups'],function ($api) {
            $api->get('/', 'Api\Groups\ApiGroupController@index');
            $api->get('/{id}', 'Api\Groups\ApiGroupController@show');
        });

        //send sms
        $api->group(['prefix' => 'sms'],function ($api) {
            $api->get('/getSmsOutbox', 'Api\Sms\ApiSmsOutboxController@index');
            $api->post('/sendSms', 'Api\Sms\ApiSmsOutboxController@store');
        });

        //products
        $api->group(['prefix' => 'products'], function ($api) {
            $api->get('/', 'Api\Product\ApiProductController@index');
            $api->get('/{id}', 'Api\Product\ApiProductController@show');
        });




        ///////////*************** START AUTHENTICATED ROUTES *******************///////////////


        $api->group(['middleware' => ['auth:api'], ], function ($api) {

            //user
            $api->group(['prefix' => 'user'], function ($api) {
                $api->get('/', 'Api\Users\ApiUsersController@loggeduser');
            });

            //Accounts
            $api->group(['prefix' => 'globalaltars'], function ($api) {
                $api->get('/', 'Api\globalaltar\ApiGlobalAltarController@index');
                $api->post('/', 'Api\globalaltar\ApiGlobalAltarController@store');
                $api->get('/{id}', 'Api\globalaltar\ApiGlobalAltarController@show');
                $api->put('/{id}', 'Api\globalaltar\ApiGlobalAltarController@update');
                $api->patch('/{id}', 'Api\globalaltar\ApiGlobalAltarController@update');
                $api->delete('/{id}', 'Api\globalaltar\ApiGlobalAltarController@destroy');
            });

            //Charges
            $api->group(['prefix' => 'charges'], function ($api) {
                $api->get('/', 'Api\Charge\ApiChargeController@index');
                $api->post('/', 'Api\Charge\ApiChargeController@store');
                $api->get('/{id}', 'Api\Charge\ApiChargeController@show');
                $api->put('/{id}', 'Api\Charge\ApiChargeController@update');
                $api->patch('/{id}', 'Api\Charge\ApiChargeController@update');
                $api->delete('/{id}', 'Api\Charge\ApiChargeController@destroy');
            });

            //Gl Accounts
            $api->group(['prefix' => 'glaccounts'], function ($api) {
                $api->get('/', 'Api\GlAccount\ApiGlAccountController@index');
                $api->post('/', 'Api\GlAccount\ApiGlAccountController@store');
                $api->get('/{id}', 'Api\GlAccount\ApiGlAccountController@show');
                $api->put('/{id}', 'Api\GlAccount\ApiGlAccountController@update');
                $api->patch('/{id}', 'Api\GlAccount\ApiGlAccountController@update');
                $api->delete('/{id}', 'Api\GlAccount\ApiGlAccountController@destroy');
            });

            //loan applications
            $api->group(['prefix' => 'loan-applications'], function ($api) {
                $api->get('/', 'Api\LoanApplication\ApiLoanApplicationController@index');
                $api->post('/', 'Api\LoanApplication\ApiLoanApplicationController@store');
                $api->get('/{id}', 'Api\LoanApplication\ApiLoanApplicationController@show');
                $api->put('/{id}', 'Api\LoanApplication\ApiLoanApplicationController@update');
                $api->patch('/{id}', 'Api\LoanApplication\ApiLoanApplicationController@update');
                $api->delete('/{id}', 'Api\LoanApplication\ApiLoanApplicationController@destroy');
            });

            //savings-deposit-accounts
            $api->group(['prefix' => 'savings-deposit-accounts'], function ($api) {
                $api->get('/', 'Api\Account\ApiSavingsDepositAccountController@index');
                $api->post('/', 'Api\Account\ApiSavingsDepositAccountController@store');
                $api->get('/{id}', 'Api\Account\ApiSavingsDepositAccountController@show');
                $api->put('/{id}', 'Api\Account\ApiSavingsDepositAccountController@update');
                $api->patch('/{id}', 'Api\Account\ApiSavingsDepositAccountController@update');
                $api->delete('/{id}', 'Api\Account\ApiSavingsDepositAccountController@destroy');
            });



            //products
            $api->group(['prefix' => 'products'], function ($api) {
                $api->post('/', 'Api\Product\ApiProductController@store');
                $api->put('/{id}', 'Api\Product\ApiProductController@update');
                $api->patch('/{id}', 'Api\Product\ApiProductController@update');
                $api->delete('/{id}', 'Api\Product\ApiProductController@destroy');
            });


            //sms routes
            $api->group(['prefix' => 'sms'],function ($api) {

                $api->get('/getaccounts', 'Api\Sms\SmsAccountController@getBulkSmsAccounts');
                $api->get('/getaccount', 'Api\Sms\SmsAccountController@getBulkSmsAccount');
                $api->get('/getinbox', 'Api\Sms\SmsAccountController@smsInbox');
                $api->get('/sendsms', 'Api\Sms\SmsAccountController@sendBulkSms');
                $api->post('/sendsms', 'Api\Sms\SmsAccountController@sendBulkSms');

            });

            //mpesa routes
            $api->group(['prefix' => 'mpesa'],function ($api) {

                $api->get('/getpayments', 'Api\Mpesa\MpesaIncomingController@getPayments');
                $api->post('/checkout', 'Api\Mpesa\MpesaOutgoingController@checkout');

            });

            $api->group(['prefix' => 'users'], function ($api) {
                $api->get('/', 'Api\Users\ApiUsersController@index');
                $api->get('/{uuid}', 'Api\Users\ApiUsersController@show');
                $api->put('/{uuid}', 'Api\Users\ApiUsersController@update');
                $api->patch('/{uuid}', 'Api\Users\ApiUsersController@update');
                $api->delete('/{uuid}', 'Api\Users\ApiUsersController@destroy');
            });

            $api->group(['prefix' => 'roles'], function ($api) {
                $api->get('/', 'Api\Users\RolesController@index');
                $api->post('/', 'Api\Users\RolesController@store');
                $api->get('/{uuid}', 'Api\Users\RolesController@show');
                $api->put('/{uuid}', 'Api\Users\RolesController@update');
                $api->patch('/{uuid}', 'Api\Users\RolesController@update');
                $api->delete('/{uuid}', 'Api\Users\RolesController@destroy');
            });

            $api->get('permissions', 'Api\Users\PermissionsController@index');

            $api->group(['prefix' => 'me'], function($api) {
                $api->get('/', 'Api\Users\ProfileController@index');
                $api->put('/', 'Api\Users\ProfileController@update');
                $api->patch('/', 'Api\Users\ProfileController@update');
                $api->put('/password', 'Api\Users\ProfileController@updatePassword');
            });

        });


        ///////////***************** END AUTHENTICATED ROUTES ********************///////////////



    });

});



