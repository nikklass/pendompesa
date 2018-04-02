<?php
session_start();

use App\Entities\Account;
use App\Entities\Company;
use App\Entities\ConfirmCode;
use App\Entities\Group;
use App\Entities\MpesaPaybill;
use App\Entities\Product;
use App\Entities\SmsOutbox;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Maatwebsite\Excel\Facades\Excel;
use Propaganistas\LaravelPhone\PhoneNumber;


//SEND SMS
function sendApiSms($data) {
	
	//******************* START SEND SMS VIA API ***********************//
	$username = config('constants.passport.username');
    $password = config('constants.passport.password');
    $send_sms_url = config('constants.bulk_sms.send_sms_url');

    //check if session data exists, use it if so
    $access_token = "";
    $refresh_token = "";
    $access_token_expires_in = "";
    $access_token_expires_time = "";

    if(isset($_SESSION["pendoadmin_access_token"])){
	    $access_token = $_SESSION['pendoadmin_access_token'];
	}
	if(isset($_SESSION["pendoadmin_refresh_token"])){
	    $refresh_token = $_SESSION['pendoadmin_refresh_token'];
	}
	if(isset($_SESSION["pendoadmin_access_token_expires_in"])){
	    $access_token_expires_in = $_SESSION['pendoadmin_access_token_expires_in'];
	}
	if(isset($_SESSION["pendoadmin_access_token_expires_time"])){
	    $access_token_expires_time = $_SESSION['pendoadmin_access_token_expires_time'];
	}

	if ($access_token) {
		$current_time = time();
		//if current time + 500 is less than expires time, fetch new token
		if ($current_time + 500 < $access_token_expires_in) {
			//fetch new access token
			//get access token
    		$access_token = prepare_access_token($username, $password);
    		//dump('new token');
		} else {
			//dump('nutin new here');
		}
		
	} else {
		$access_token = prepare_access_token($username, $password);
		//dump(' new tkn');
	}
	//dd($access_token, $refresh_token, $access_token_expires_in, $access_token_expires_time, time());

    //set params
    $params = [
        'json' => [
            "sms_message"=> $data['sms_message'],
            "phone_number"=> $data['phone_number']
        ]
    ];

    //log_this(">>>>>>>>> YEHUAPI SMS URL :\n\n$send_sms_url :\n\n$params\n\n\n");
    
    //start create new sms
    $result = sendAuthPostApi($send_sms_url, $access_token, $params);
    //dd($result);

    return $result;

    //log_this(">>>>>>>>> YEHUAPI SEND SMS API RESULT :\n\n$result\n\n\n");

    //end create new sms
    //******************* END SEND SMS VIA API ***********************//

}

//******************* START SMS API FUNCTIONS ********************//

    //start get pendoadmin access token
    function prepare_access_token($username, $password)
    {
        try
        {
            $body = [
                'json' => [
                    "username" => $username,
                    "password" => $password
                ]
            ];

            $url = config('constants.passport.token_url');
            $dataclient = getTokenGuzzleClient();
            $response = $dataclient->request('POST', $url, $body);
            $result = json_decode($response->getBody());

            //store token in session
    		$_SESSION['pendoadmin_access_token'] = $result->access_token;
    		$_SESSION['pendoadmin_refresh_token'] = $result->refresh_token;
    		$_SESSION['pendoadmin_access_token_expires_in'] = $result->expires_in;
    		$_SESSION['pendoadmin_access_token_expires_time'] = time() + $result->expires_in;

            //return access_token
            return $result->access_token; 
            
        } catch (RequestException $e) {
            $response = handleAccessTokenError($e, $url, $username, $password);
            return $response;
        }
    }
    //end get pendoadmin access token

    //send params with access_token to api
    function sendAuthPostApi($url, $token, $params)
    {
        try
        {
            $dataclient = getGuzzleClient($token);
            $response = $dataclient->request('POST', $url, $params);
            $result = $response->getBody()->getContents();

            return $result;
        } catch (RequestException $e) {
            return handleGuzzleError($e);
        }
    }

  //start handle guzzle errors
    function handleAccessTokenError($e, $url, $username, $password)
    {
        $status_code = $e->getResponse()->getStatusCode();
        if ($status_code == 400)
        {
            prepare_access_token($username, $password);
        }
    }

    function handleGuzzleError(RequestException $e) {

        //$response_message = Psr7\str($e->getResponse());
        $status_code = $e->getResponse()->getStatusCode();
        $message = $e->getMessage();

        $response["error"] = true;
        $response["status_code"] = $status_code;
        $response["message"] = $message;

        return $response;
    }
    //end handle guzzle errors


//******************* END SMS API FUNCTIONS ********************//

function createConfirmCode($confirm_code, $sms_type_id, $user_id, $phone='', $phone_country='', $email='') {

    //start disable any previous sent registration sms to this number
    $status_disabled = config('constants.status.disabled');
    $status_active = config('constants.status.active');

    if ($email) {
        
        DB::table('confirm_codes')
                    ->where('email', $email)
                    ->where('sms_type_id', $sms_type_id)
                    ->where('status_id', $status_active)
                    ->update(['status_id' => $status_disabled]);

        $attributes['email'] = $email;

        //start create new confirm code                
        $attributes['confirm_code'] = $confirm_code;
        $attributes['status_id'] = $status_active;
        $attributes['sms_type_id'] = $sms_type_id;
        $attributes['user_id'] = $user_id;

        ConfirmCode::create($attributes);
        //end create new sms confirm code

    } 

    if ($phone && $phone_country) {
        
        DB::table('confirm_codes')
                    ->where('phone', $phone)
                    ->where('phone_country', $phone_country)
                    ->where('sms_type_id', $sms_type_id)
                    ->where('status_id', $status_active)
                    ->update(['status_id' => $status_disabled]);

        $attributes['phone'] = $phone;
        $attributes['phone_country'] = $phone_country;

        //start create new confirm code                
        $attributes['confirm_code'] = $confirm_code;
        $attributes['status_id'] = $status_active;
        $attributes['sms_type_id'] = $sms_type_id;
        $attributes['user_id'] = $user_id;

        ConfirmCode::create($attributes);
        //end create new sms confirm code

    }
    
    //end disable any previous sent registration sms to this number
    
}

function createSmsOutbox($message, $phone) {
	
	$sms_user_name = config('constants.bulk_sms.usr');
    $company_id = config('constants.bulk_sms.company_id');

	//start create new outbox
    $sms_attributes['message'] = $message;
    $sms_attributes['company_id'] = $company_id;
    $sms_attributes['sms_user_name'] = $sms_user_name;
    $sms_attributes['phone_number'] = $phone;
    $sms_attributes['created_by'] = $company_id;
    $sms_attributes['updated_by'] = $company_id;

    $smsoutbox = new SmsOutbox();
    $smsoutbox = $smsoutbox->create($sms_attributes);
    //end create new outbox

    return $smsoutbox;

}

function getHttpStatus($url) {
	$http = curl_init($url);
	// do your curl thing here
	$result = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	curl_close($http);
	return $http_status;
}
/**
* change plain number to formatted currency

/*generate user account number*/
function generate_account_number($company_id, $user_cd, $group_id='', $account_type='') {
	
	//get the highest account number and add 1 to it
	/*$accounts_data = DB::table('accounts')
                     ->select(DB::raw('max(id) as account_id'))
                     ->first();
    $account_id = $accounts_data->account_id;

    //get the account number
    $account_details = Account::find($account_id);
    $account_no = $account_details->account_no;

    //get the account number part and add 1 to it
    //$user_account_part = substr(trim($account_no),-6);
    $user_account_part = substr($account_no, 6, 6);
    //dd($account_no, $user_account_part);

    //add +1 to get new account number sequence
    $next_account_number = $user_account_part + 1;
    $next_account_number = sprintf('%06d', $next_account_number);*/

    //get company data to use in account number formulation
    $company_data = Company::find($company_id);
    $company_cd = $company_data->company_cd;

    //get account type to use in account number formulation
    if ($account_type) {
    	$account_type_data = Product::find($account_type);
    	$account_type_cd = $account_type_data->product_cd;
    } else {
    	$account_type_cd = config('constants.account_settings.default_account_type_cd');
    }

    //get group data to use in account number formulation
    if ($group_id) {
    	$group_data = Group::find($group_id);
    	$group_cd = $group_data->group_cd;
    } else {
    	$group_cd = config('constants.account_settings.default_group_cd');
    }

    //formulate user cd
    $next_account_number = sprintf('%06d', $user_cd);

    //formulate new account number
    //dd($company_cd, $group_cd, $next_account_number, $account_type_cd);
    $account_number = $company_cd . $group_cd . $next_account_number . $account_type_cd;

    return $account_number;

}


/*generate user account number*/
function generate_user_cd() {
	
	//get the highest account number and add 1 to it
	$users_data = DB::table('users')
                     ->select(DB::raw('max(user_cd) as user_cd'))
                     ->first();
    $max_user_cd = $users_data->user_cd;

    if ($max_user_cd) {
	    //add +1 to get new account number sequence
	    $next_user_cd = $max_user_cd + 1;
	} else {
	    //add +1 to get new account number sequence
	    $next_user_cd = 1;
	}

    return $next_user_cd;

}


/*
* @param $number
* @param $currency
*/
function formatCurrency($number, $decimals = 2, $currency = 'Ksh')
{
    return $currency . " " . format_num($number, $decimals, '.', ',');
}

//format number 
function format_num($num, $decimals=2) {
	if (checkCharExists(',', $num)) {
		return $num;
	}
	return number_format($num, $decimals, '.', ',');
}

//format api validation errors
function formatValidationErrors($errors) {
    //loop thru validation errors
    $error_messages = [];
    $messages = $errors->toArray();
    foreach ($messages as $message){
        $error_messages[] = $message[0];
    }
	$json = json_encode($error_messages);
    return $json;
}

function checkCharExists($char, $value) {
	if (strpos($value, $char) !== false) {
	  return true;
	}
	return false;
}

function executeCurl($url, $method=NULL, $data_string = NULL)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization:Bearer ACCESS_TOKEN'
    )); //setting custom header
    //log_this(">>>>>>>>> CURL RESPONSE :\n\n$data_string");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if ($method == 'post') {
        curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	}
	
    return curl_exec($curl);

}

//format to local phone number
function getLocalisedPhoneNumber($phone_number, $country_code='KE') {    
	$phone_number = PhoneNumber::make($phone_number, $country_code)->formatNational();
	//remove spaces
	return str_replace(" ", "", $phone_number);

}

//format to international phone number with spaces in between
function getInternationalPhoneNumber($phone_number, $country_code='KE') {    
	return PhoneNumber::make($phone_number, $country_code)->formatInternational();
}

//format to international phone number with no spaces in between
function getInternationalPhoneNumberNoSpaces($phone_number, $country_code='KE') {    
	return PhoneNumber::make($phone_number, $country_code)->formatE164();
}

//format to db format, remove plus (+) sign
function getDatabasePhoneNumber($phone_number, $country_code='KE') {    
	$phone_number = PhoneNumber::make($phone_number, $country_code)->formatE164();
	//return str_replace("+", "", $phone_number);
    return $phone_number;
}

//format for dialling in country
function getForMobileDialingPhoneNumber($phone_number, $country_code='KE', $dialling_country_code='KE') {    
	return PhoneNumber::make($phone_number, $country_code)->formatForMobileDialingInCountry($dialling_country_code);
}

//format phone number
function formatPhoneNumber($phone_number) {    
	return   "254". substr(trim($phone_number),-9); 
}

//check for valid phone number
function isValidPhoneNumber($phone_number) {
        		
	$phone_number_status = false; 
	
	$phone_number = trim($phone_number);
	
	if (strlen($phone_number) == 12) 
	{
		$pattern = "/^2547(\d{8})$/";
		if (preg_match($pattern, $phone_number)) {
			$phone_number_status = true;
		}
	}
	
	if (strlen($phone_number) == 13) 
	{
		$pattern = "/^\+2547(\d{8})$/";
		if (preg_match($pattern, $phone_number)) {
			$phone_number_status = true;
		}
	}
	
	if (strlen($phone_number) == 10) 
	{
		$pattern = "/^07(\d{8})$/";
		if (preg_match($pattern, $phone_number)) {
			$phone_number_status = true;
		}
	}

	if (strlen($phone_number) == 9) 
	{
		$pattern = "/^7(\d{8})$/";
		if (preg_match($pattern, $phone_number)) {
			$phone_number_status = true;
		}
	}

    return  $phone_number_status;
	
}

//validate an email address
function validateEmail($email) {

	return preg_match("/^(((([^]<>()[\.,;:@\" ]|(\\\[\\x00-\\x7F]))\\.?)+)|(\"((\\\[\\x00-\\x7F])|[^\\x0D\\x0A\"\\\])+\"))@((([[:alnum:]]([[:alnum:]]|-)*[[:alnum:]]))(\\.([[:alnum:]]([[:alnum:]]|-)*[[:alnum:]]))*|(#[[:digit:]]+)|(\\[([[:digit:]]{1,3}(\\.[[:digit:]]{1,3}){3})]))$/", $email);

}

//format date
function formatFriendlyDate($date) {
    if ($date) {
        return Carbon::parse($date)->format('d-M-Y, H:i');
    } else {
        return null;
    }
}

//format display date
function formatDisplayDate($date) {
    if ($date) {
        return Carbon::parse($date)->format('d-M-Y');
    } else {
        return null;
    }
}

//format datepicker date
function formatDatePickerDate($date) {
	if ($date) {
        return Carbon::parse($date)->format('d-m-Y');
    } else {
        return null;
    }
}

//convert alphabet to num, e.g. A=1, B=2, Z=25, AA=26, ETC
function letterToNum($number) {
    $alphabet = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
	return $alphabet[$number];
}

//get url to be cached
function getFullCacheUrl($url, $params) {

        //Sorting query params by key (acts by reference)
        ksort($params);

        //Transforming the query array to query string
        $queryString = http_build_query($params);

        $fullUrl = "{$url}?{$queryString}";

        return $fullUrl;

}

//get cache duration - for caching pages
function getCacheDuration($config='') {
        
        if ($config == 'low') {
		    $minutes = config('app.cache_minutes_low');
		} else {
		    $minutes = config('app.cache_minutes');
		}

        return $minutes;

}

function downloadExcelFile($excel_name, $excel_title, $excel_desc, $data_array, $data_type, $columns=8) {

	Excel::create($excel_name, function($excel) use ($data_array, $excel_name, $excel_title, $excel_desc, $columns) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle($excel_title);
        $excel->setCreator(config('app.name'))->setCompany(config('app.name'));
        $excel->setDescription($excel_desc);

        // Build the spreadsheet, passing in the data array
        $excel->sheet("sheet1", function($sheet) use ($data_array, $excel_name, $excel_title, $excel_desc, $columns) {
            
            $sheet->fromArray($data_array, null, 'A1', false, false);
            // Set auto size for sheet
			$sheet->setAutoSize(true);

			// Sets all borders
			$sheet->setAllBorders('thin');

			//get last column letter
			$letter = letterToNum($columns);
            //dd('A1:' . $letter . '1');

			$sheet->cells('A1:' . $letter . '1', function($cells) {
				// Set black background
				//$cells->setBackground('#000000');
				// Set with font color
				//$cells->setFontColor('#ffffff');

				// Set font family
				$cells->setFontFamily('Calibri');

				// Set font size
				$cells->setFontSize(14);

				// Set font weight to bold
				$cells->setFontWeight('bold');

			});

        });

    })->download($data_type);

}

//shorten text title
function reducelength($str,$maxlength=100) {
	if (strlen($str) > $maxlength) {
		$newstr = substr($str,0,$maxlength-3) . "...";	
	} else {
		$newstr = $str;
	}
	return $newstr;
}

/// function to generate random number ///////////////
function generateCode($length = 5, $add_dashes = false, $available_sets = 'ud')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
	$password = str_shuffle($password);
	if(!$add_dashes)
		return $password;
	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
} 
// end of generate random number function

//get paybill name
function getPaybillName($paybill_no) {
	$res = MpesaPaybill::where('paybill_number', $paybill_no)->first();
	$name = $res->name;
	return $name;
}

function getUserAgent(){
	return @$_SERVER["HTTP_USER_AGENT"]?$_SERVER["HTTP_USER_AGENT"]: "" ;
}

function getIp(){
	$ip = request()->ip();
    return $ip;
}

function getHost() {
	return @$_SERVER["REMOTE_HOST"]? $_SERVER["REMOTE_HOST"]: "" ; 
}

function getLocalDate($date) {
	//return Carbon::parse($date)->timezone(getLocalTimezone());
	$timezone = config('app.local_timezone');
	//return Carbon::parse($date)->timezone($timezone)->format($format);
	return Carbon::parse($date)->timezone($timezone);
}

function getLocalTimezone() {
	//get user timezone and return, 
	//if blank return default timezone ('Africa/Nairobi')
	//$location = getUserLocation();
	//$userTimezone=$location->timezone;
	$userTimezone = '';
	if ($userTimezone) {
		$timezone = $userTimezone;
	} else {
		$timezone = config('app.local_timezone');
	}
	return $timezone;
}

function getJsonOauthData() {
	
	$data = [
	        'json' => [
	            "grant_type"=> "password",
				"client_id"=> config('constants.oauth.client_id'),
				"client_secret"=> config('constants.oauth.client_secret'),
				"username"=> config('constants.oauth.username'),
				"password"=> config('constants.oauth.password'),
				"scope"=> ""
	        ]
	    ];

	return $data;

}

function getyehuJsonOauthData() {
	
	$data = [
	        'json' => [
	            "grant_type"=> "password",
				"client_id"=> config('constants.yehuoauth.client_id'),
				"client_secret"=> config('constants.yehuoauth.client_secret'),
				"username"=> config('constants.yehuoauth.username'),
				"password"=> config('constants.yehuoauth.password'),
				"scope"=> ""
	        ]
	    ];

	return $data;

}

function getBulkSmsJsonOauthData() {
	
	$data = [
	        'json' => [
	            "grant_type"=> "password",
				"client_id"=> config('constants.bulk_sms.client_id'),
				"client_secret"=> config('constants.bulk_sms.client_secret'),
				"username"=> config('constants.bulk_sms.username'),
				"password"=> config('constants.bulk_sms.password'),
				"scope"=> ""
	        ]
	    ];

	return $data;

}

// fetching remote mpesa payments data
function getMpesaPayments($data) {

	//dd($data);
	$body = [];
	//get bulk sms data for this client
	$get_mpesa_data_url = config('constants.mpesa.getpayments_url');

	//url params
	if ($data->id) { $body['id'] = $data->id; }
	if ($data->page) { $body['page'] = $data->page; }
	if ($data->limit) { $body['limit'] = $data->limit; }
	if ($data->report) { $body['report'] = $data->report; }
	if ($data->paybills) { $body['paybills'] = $data->paybills; }
	if ($data->phone_number) { $body['phone_number'] = $data->phone_number; }
	if ($data->account_name) { $body['account_name'] = $data->account_name; }
	if ($data->start_date) { $body['start_date'] = $data->start_date; }
	if ($data->end_date) { $body['end_date'] = $data->end_date; }

	//dd($body);

	//get sms urls
	$get_oauth_token_url = config('constants.oauth.token_url');

    //get oauth access token
    $tokenclient = getTokenGuzzleClient();

    $oauth_json_data = getJsonOauthData();

    $resp = $tokenclient->request('POST', $get_oauth_token_url, $oauth_json_data); 

    if ($resp->getBody()) {
    
        $result = json_decode($resp->getBody());
        $access_token = $result->access_token;
        $refresh_token = $result->refresh_token;
        //dd($result);

        try {

            //send request to get mpesa
            $dataclient = getGuzzleClient($access_token);
            $respons = $dataclient->request('GET', $get_mpesa_data_url, [
                'query' => $body
                //,'http_errors' => false
            ]);

            if ($respons->getStatusCode() == 200) {

                if ($respons->getBody()) {
        
                    $response = json_decode($respons->getBody());
                    //dd($get_mpesa_data_url, $response);

                } else {
			
					$response["error"] = true;
					$response["message"] = "An error occured while fetching mpesa data";
					
			    }

			    return $response; 

            }  

        } catch (RequestException $e) {

            return handleGuzzleError($e);
            //return $e;

        }

    } 
	
	//return $response; 
	
}


// fetching local yehu deposits data
function getLocalYehuDeposits($data) {

	//dd($data);
	$body = [];
	//get bulk sms data for this client
	$get_local_yehu_deposits_data_url = config('constants.yehu.getdepositslocal_url');
	//dd($get_local_yehu_deposits_data_url);

	//url params
	if ($data->id) { $body['id'] = $data->id; }
	if ($data->page) { $body['page'] = $data->page; }
	if ($data->limit) { $body['limit'] = $data->limit; }
	if ($data->report) { $body['report'] = $data->report; }
	if ($data->paybills) { $body['paybills'] = $data->paybills; }
	if ($data->phone_number) { $body['phone_number'] = $data->phone_number; }
	if ($data->acct_no) { $body['acct_no'] = $data->acct_no; }
	if ($data->bu_id) { $body['bu_id'] = $data->bu_id; }
	if ($data->trans_id) { $body['trans_id'] = $data->trans_id; }
	if ($data->processed) { $body['processed'] = $data->processed; }
	if ($data->failed) { $body['failed'] = $data->failed; }
	if ($data->start_date) { $body['start_date'] = $data->start_date; }
	if ($data->end_date) { $body['end_date'] = $data->end_date; }

	//dd($body);

	//get sms urls
	//$get_oauth_token_url = config('constants.yehuoauth.token_url');

    //get oauth access token
    //$tokenclient = getTokenGuzzleClient();

    //$oauth_json_data = getYehuJsonOauthData();

    //$resp = $tokenclient->request('POST', $get_oauth_token_url, $oauth_json_data); 

    //if ($resp->getBody()) {
    
        /*$result = json_decode($resp->getBody());
        $access_token = $result->access_token;
        $refresh_token = $result->refresh_token;
        */

        try {

            //send request to get mpesa
            //$dataclient = getGuzzleClient($access_token);
            $dataclient = getTokenGuzzleClient();
            $respons = $dataclient->request('GET', $get_local_yehu_deposits_data_url, [
                'query' => $body
            ]);

            if ($respons->getStatusCode() == 200) {

                if ($respons->getBody()) {
        
                    $result = json_decode($respons->getBody());
                    $response["error"] = false;
					$response["message"] = $result;

                } else {
			
					$response["error"] = true;
					$response["message"] = "An error occured while fetching local yehu deposits data";
					
			    }

			    return $response; 

            }  

        } catch (\Exception $e) {
            
            return handleGuzzleError($e);

        }

    //} 
	
	return $response; 
	
}

// fetching remote yehu deposits data
function getRemoteYehuDeposits($data) {

	$body = [];
	//get yehu deposit
	$get_yehu_deposits_data_url = config('constants.yehu.getdepositsremote_url');

	//url params
	if ($data->id) { $body['id'] = $data->id; }
	if ($data->page) { $body['page'] = $data->page; }
	if ($data->limit) { $body['limit'] = $data->limit; }
	if ($data->report) { $body['report'] = $data->report; }
	if ($data->paybills) { $body['paybills'] = $data->paybills; }
	if ($data->phone_number) { $body['phone_number'] = $data->phone_number; }
	if ($data->acct_no) { $body['acct_no'] = $data->acct_no; }
	if ($data->bu_id) { $body['bu_id'] = $data->bu_id; }
	if ($data->trans_id) { $body['trans_id'] = $data->trans_id; }
	if ($data->processed) { $body['processed'] = $data->processed; }
	if ($data->failed) { $body['failed'] = $data->failed; }
	if ($data->start_date) { $body['start_date'] = $data->start_date; }
	if ($data->end_date) { $body['end_date'] = $data->end_date; }

	//get sms urls
	//$get_oauth_token_url = config('constants.yehuoauth.token_url');

    //get oauth access token
    //$tokenclient = getTokenGuzzleClient();

    //$oauth_json_data = getYehuJsonOauthData();

    //$resp = $tokenclient->request('POST', $get_oauth_token_url, $oauth_json_data); 

    //if ($resp->getBody()) {
    
        /*$result = json_decode($resp->getBody());
        $access_token = $result->access_token;
        $refresh_token = $result->refresh_token;
        */

        try {

            //send request to get mpesa
            //$dataclient = getGuzzleClient($access_token);
            $dataclient = getTokenGuzzleClient();
            $respons = $dataclient->request('GET', $get_yehu_deposits_data_url, [
                'query' => $body 
                //, 'http_errors' => false
            ]);

            if ($respons->getStatusCode() == 200) {

                if ($respons->getBody()) {
        
                    $result = json_decode($respons->getBody());
                    $response["error"] = false;
					$response["message"] = $result;

                } else {
			
					$response["error"] = true;
					$response["message"] = "An error occured while fetching remote yehu deposits data";
					
			    }

			    return $response; 

            }  

        } catch (RequestException $e) {

            return handleGuzzleError($e);
            //return $e;

        }

    //} 
	
}

//update existing local yehu deposit
function updateYehuDeposit($id, $data) {
	
	//update yehu deposit
	$update_yehu_deposit_data_url = config('constants.yehu.update_depositlocal_url');
	$update_yehu_deposit_data_url .=  "/" . $id;

	$user_full_names = auth()->user()->first_name . ' ' . auth()->user()->last_name;
	$user_full_names = trim($user_full_names);

	if ($data->acct_no) { $body['acct_no'] = $data->acct_no; }
	$body['updated_by'] = $user_full_names;

	//dd($update_yehu_deposit_data_url, $body);

	try {

            //send request to save deposit
            $dataclient = getTokenGuzzleClient();
            $respons = $dataclient->request('PUT', $update_yehu_deposit_data_url, [
                'query' => $body 
            ]);

            if ($respons->getStatusCode() == 200) {

                if ($respons->getBody()) {
        
                    $result = json_decode($respons->getBody());
                    $response["error"] = false;
					$response["message"] = $result;

                } else {
			
					$response["error"] = true;
					$response["message"] = "An error occured while updating local yehu deposits data";
					
			    }

			    return $response; 

            }  

        } catch (RequestException $e) {

            return handleGuzzleError($e);

        }

}

//create remote yehu deposit
function createYehuDeposit($data) {
	
	//update yehu deposit
	$create_yehu_deposit_data_url = config('constants.yehu.create_depositremote_url');

	$user_full_names = auth()->user()->first_name . ' ' . auth()->user()->last_name;
	$user_full_names = trim($user_full_names);

	if ($data->id) { $body['id'] = $data->id; }
	if ($data->acct_no) { $body['acct_no'] = $data->acct_no; }
	if ($data->amount) { $body['amount'] = $data->amount; }
	if ($data->paybill_number) { $body['paybill_number'] = $data->paybill_number; }
	if ($data->full_name) { $body['full_name'] = $data->full_name; }
	if ($data->phone_number) { $body['phone_number'] = $data->phone_number; }
	if ($data->src_ip) { $body['src_ip'] = $data->src_ip; }
	if ($data->trans_id) { $body['trans_id'] = $data->trans_id; }
	$body['updated_by'] = $user_full_names;
	//dd($create_yehu_deposit_data_url, $body);

	try {

        //send request to save deposit
        $dataclient = getTokenGuzzleClient();
        $respons = $dataclient->request('POST', $create_yehu_deposit_data_url, [
            'query' => $body 
        ]);
        //dd($respons);

        if ($respons->getStatusCode() == 200) {

            if ($respons->getBody()) {
    
                $result = json_decode($respons->getBody());
                $response["error"] = false;
				$response["message"] = $result;

            } else {
		
				$response["error"] = true;
				$response["message"] = "An error occured while creating remote yehu deposit";
				
		    }

		    return $response; 

        }  

    } catch (RequestException $e) {

        return handleGuzzleError($e);

    }

}


// fetching bulk sms data
function getCompanyBulkSMSData($company_id) {
	
	$company_data = Company::find($company_id);
	$sms_user_name = $company_data->sms_user_name;
	$data = getRealSMSData($sms_user_name);

	return $data;

}

function getBulkSMSData($user_id) {
		
	$user = User::where('id', $user_id)
		->with('company')
		->first();
	
	$sms_user_name = "";
	if ($user->company) {
		$sms_user_name = $user->company->sms_user_name;
	}

	$data = getRealSMSData($sms_user_name);

	return $data;

}

function getRealSMSData($sms_user_name) {
		
	/*$user = User::where('id', $user_id)
		->with('company')
		->first();
	
	$sms_user_name = "";
	if ($user->company) {
		$sms_user_name = $user->company->sms_user_name;
	}*/
	//$sms_user_name = "steve";

	if ($sms_user_name) {

		//get bulk sms data for this client
		$get_sms_data_url = config('constants.bulk_sms.get_sms_data_url');

		//url params
		$body['username'] = $sms_user_name;

		//get sms urls
		$get_oauth_token_url = config('constants.oauth.token_url');

	    //get oauth access token
	    $tokenclient = getTokenGuzzleClient();

	    $oauth_json_data = getJsonOauthData();

	    $resp = $tokenclient->request('POST', $get_oauth_token_url, $oauth_json_data); 

	    if ($resp->getBody()) {
        
	        $result = json_decode($resp->getBody());
	        $access_token = $result->access_token;
	        $refresh_token = $result->refresh_token;

	        try {

	            //send request to send sms
	            $dataclient = getGuzzleClient($access_token);
	            $respons = $dataclient->request('GET', $get_sms_data_url, [
	                'query' => $body
	            ]);

	            if ($respons->getStatusCode() == 200) {

	                if ($respons->getBody()) {
	        
	                    $result = json_decode($respons->getBody());
	                    //dd($result);

	                    $response["error"] = false;
						$response["sms_user_name"] = $sms_user_name;
						$response["passwd"] = $result->data->passwd;
						$response["alphanumeric_id"] = $result->data->alphanumeric_id;
						$response["fullname"] = $result->data->fullname;
						$response["rights"] = $result->data->rights;
						$response["active"] = $result->data->active;
						$response["default_sid"] = $result->data->default_sid;
						$response["default_source"] = $result->data->default_source;
						$response["paybill"] = $result->data->paybill;
						$response["relationship"] = $result->data->relationship;
						$response["home_ip"] = $result->data->home_ip;
						$response["default_priority"] = $result->data->default_priority;
						$response["default_dest"] = $result->data->default_dest;
						$response["default_msg"] = $result->data->default_msg;
						$response["sms_balance"] = $result->data->sms_balance;
						$response["sms_expiry"] = $result->data->sms_expiry;
						$response["routes"] = $result->data->routes;
						$response["last_updated"] = $result->data->last_updated;	

	                } else {
				
						$response["error"] = true;
						$response["message"] = "An error occured while fetching bulk sms account";
						
				    }

				    return $response; 

	            }  

	        } catch (\Exception $e) {
	            dd($e);
	        }

	    } 

	} else {
				
		$response["error"] = true;
		$response["message"] = "No SMS account exists";
		
    }
	
	return $response; 
	
}


//send sms
function sendSms($params) {

	//get data array
	$body['usr'] = $params['usr'];
    $body['pass'] = $params['pass'];
    $body['src'] = $params['src'];
    $body['dest'] = $params['phone_number'];
    $body['msg'] = $params['sms_message'];

	//get urls
	$get_oauth_token_url = config('constants.oauth.token_url');
	$send_sms_url = config('constants.bulk_sms.send_sms_url');

    //get oauth access token
    $tokenclient = getTokenGuzzleClient();

    $oauth_json_data = getJsonOauthData();

	$resp = $tokenclient->request('POST', $get_oauth_token_url, $oauth_json_data);

    if ($resp->getBody()) {
        
        $result = json_decode($resp->getBody());
        $access_token = $result->access_token;
        $refresh_token = $result->refresh_token;

        try {

            //send request to send sms
            $dataclient = getGuzzleClient($access_token);
            $respons = $dataclient->request('POST', $send_sms_url, [
                'query' => $body
            ]);

            if ($respons->getStatusCode() == 200) {

                if ($respons->getBody()) {
        
                    $result = json_decode($respons->getBody());
                    //dd($result);

                    // get results
					if  ($result->success) {
						
						//show data
						$response["error"] = false;
						$response["message"] = $result->success->message;
				        
				    } else {
						
						$response["error"] = true;
						$response["message"] = $result->success->message;
						
				    }

                } else {
			
					$response["error"] = true;
					$response["message"] = "An error occured while sending sms";
					
			    }

			    return $response; 

            }  

        } catch (\Exception $e) {

            return handleGuzzleError($e);

        }

    }

}


//check if paybill is valid	
function isPaybillValid($est_id, $user_id=NULL, $admin=NULL) {
	
	$response = array();
	
	$results = array();

	if (!$user_id) { $user_id = USER_ID; }
	
	//check user permissions
	$super_admin = $this->isSuperAdmin($user_id);
	if ($admin && !$super_admin) {
		$perms = ALL_MPESA_TRANS_PERMISSIONS; 
		$company_ids = $this->getUserCompanyIds($user_id, $perms, $est_id); 
	}
	
	if ($super_admin || ($admin && $company_ids)) {
		
		//get bulk sms data
		$bulk_sms_data = $this->getBulkSMSData(BULK_SMS_USERNAME); 
		$usr = $est_id;
		$pass = $bulk_sms_data["passwd"];
		$src = $bulk_sms_data["default_source"];
		$paybill_no = $bulk_sms_data["paybill"];
					
		if ($usr && $pass && $paybill_no) {
		
			//show success msg
			$response["message"] = SUCCESS_MESSAGE;
			$response["error"] = false;
		
		} else {
			
			//get est name
			$est_data_items = $this->getEstablishments("", $est_id);
			$est_data_item = $est_data_items["rows"][0];
			$est_name = $est_data["name"];
			
			//show error msg
			$response["message"] = sprintf(NO_PAYBILL_NUMBER_ERROR_MESSAGE, $est_name);
			$response["error_type"] = NO_PERMISSION_ERROR;
			$response["error"] = true;
		
		}
		
	} else {
		
		//show error msg
		$response["message"] = NO_PERMISSION_ERROR_MESSAGE;
		$response["error_type"] = NO_PERMISSION_ERROR;
		$response["error"] = true;
		
	}
	
	return $response; 

}

function getGuzzleClient($token)
{
    return new \GuzzleHttp\Client([
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ],
    ]);
}

function getTokenGuzzleClient()
{
    return new \GuzzleHttp\Client([
        'headers' => [
            'Content-Type' => 'application/json'
        ]
    ]);
}

function log_this($lmsg, $logname='')
{ 

    $app_short_name = config('constants.settings.app_short_name');
    //set the log file name
    if (!$logname) { $logname = $app_short_name; }

    $date = Carbon::now();
    $date = getLocalDate($date);
    $short_date = $date->format('Ymd'); 
    $full_date = $date->format('Y-m-d H:i:s T: '); 
    
    //write to the log file
    //$ip_address = request()->ip;
    $flog = sprintf("/data/log/" . $logname . "_%s.log", $short_date);
    $tlog = sprintf("\n%s : %s", $full_date, $lmsg);
    $f    = fopen($flog, "a");
    fwrite($f, $tlog);
    fclose($f);

}