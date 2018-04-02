<?php

$api_domain_url = "/";
$api_version_url = "api/";
$api_path_url = $api_domain_url . $api_version_url;

//get main server ip address
$pendo_server_ip = env('PENDO_SERVER_IP');

$remote_pendo_api_url = "http://" . $pendo_server_ip . "/public/api/";
$remote_base_api_url = "http://" . $pendo_server_ip . "/api2/api/";

return [

    'account_settings' => [
        'default_group_cd' => env('DEFAULT_GROUP_CD'),
        'default_account_type_cd' => env('DEFAULT_ACCOUNT_TYPE_CD'),
        'savings_account_product_id' => env('SAVINGS_ACCOUNT_PRODUCT_ID'),
        'loan_repayment_account_product_id' => env('LOAN_REPAYMENT_ACCOUNT_PRODUCT_ID'),
    ],
    'routes' => [
        'get_users_url' => $api_path_url . 'users/index',
        'create_user_url' => $api_path_url . 'users/create',
        'create_message_url' => $api_path_url . 'smsoutbox/create',
        'fetch_savings_deposit_accounts_url' => $api_path_url . 'savings-deposit-accounts',
    ],
    'passport' => [
        'token_url' => $remote_pendo_api_url . 'login',
        'user_url' => $api_path_url . 'user',
        'username' => env('PENDOAPI_OAUTH_USERNAME'),
        'password' => env('PENDOAPI_OAUTH_PASSWORD'),
    ],

    'bulk_sms' => [ 
        'send_sms_url' => $remote_pendo_api_url . "sms/sendSms",
        'company_id' => env('COMPANY_ID'),
        'usr' => env('BULK_SMS_USR'),
    ],
    'mpesa' => [
        'getpayments_url' => $remote_base_api_url . 'api/mpesa/getpayments',
    ],

    'images' => [
        'no_image_full' => "images/no_image.jpg",
        'no_image_thumb' => "images/no_image.jpg",
        'no_image_thumb_400' => "images/no_image.jpg",
    ],
    'settings' => [
        'app_mode' => env('APP_MODE'),
        'app_short_name' => env('APP_SHORT_NAME'),
        'pendoadmin_app_name' => env('PENDOADMIN_APP_NAME'),
    ],
    'pendoadmin_passport' => [
        'username' => env('PENDOADMIN_PASSPORT_USERNAME'),
        'password' => env('PENDOADMIN_PASSPORT_PASSWORD'),
        'token_url' => $remote_pendo_api_url . 'login',
    ],
    'sms_types' => [ 
        'registration_sms' => "1",
        'recommendation_sms' => "2",
        'resent_registration_sms' => "3",
        'forgot_password_sms' => "4",
        'confirm_number_sms' => "5",
        'company_sms' => "6",
    ],
    'status' => [ 
        'active' => "1",
        'disabled' => "2",
        'suspended' => "3",
        'expired' => "4",
        'pending' => "5",
        'confirmed' => "6",
        'cancelled' => "7",
        'sent' => "8",
        'inactive' => "99",
    ]
];