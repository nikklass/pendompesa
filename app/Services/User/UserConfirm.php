<?php

namespace App\Services\User;

use App\User;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserConfirm 
{
    
    use Helpers;

    public function accountconfirm($request) {
    {

        //set variables
        $status_active = config('constants.status.active');
        $status_disabled = config('constants.status.disabled');

        $phone_country = $request->phone_country;
        $phone = $request->phone;
        $confirm_code = $request->confirm_code;
        $email = '';
        $local_phone = '';
        $full_phone = '';
        
        //DB::enableQueryLog();

        //check whether entry is an email or not
        // check login field
        $login_type = filter_var( $phone, FILTER_VALIDATE_EMAIL ) ? 'email' : 'phone';
        //dump($login_type);

        if ($login_type == 'email') {
            $email = $phone;
        } else {
            //get user account if active, join to confirm_codes table where status_id = 1
            $local_phone = getLocalisedPhoneNumber($phone, $phone_country);
            $full_phone = getDatabasePhoneNumber($phone, $phone_country);
        }
        
        $user = DB::table('users')
                        ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                            $query->where('users.phone', $local_phone)
                                  ->where('users.phone_country', $phone_country);
                        }, function ($query) use ($email) {
                            $query->where('users.email', $email);
                        })
                        ->first();

        if (!$user) {

            $error_message['user'] = 'User account does not exist';
            $error_message = json_encode($error_message);

            throw new StoreResourceFailedException($error_message);

        } else {

            if ($user->active == 1) {

                $error_message['user'] = 'User account is already active';
                $error_message = json_encode($error_message);

                throw new StoreResourceFailedException($error_message);

            } 

            //check if supplied code is active
            $code_data = ConfirmCode::where('confirm_code', '=', $confirm_code)
                            ->where('status_id', '=', $status_active)
                            ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                                $query->where('phone', $local_phone)
                                      ->where('phone_country', $phone_country);
                            }, function ($query) use ($email) {
                                $query->where('email', $email);
                            })
                            ->first();

            //dd($email, $local_phone, $code_data);

            if (!$code_data) {

                $error_message['user'] = 'Invalid confirmation code';
                $error_message = json_encode($error_message);

                throw new StoreResourceFailedException($error_message);

            } 
            //end check if supplied code is active

            //update the user record
            DB::table('users')
                ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                    $query->where('phone', $local_phone)
                          ->where('phone_country', $phone_country);
                }, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->update(['status_id' => $status_active, 'active' => '1']);

            //update the confirm codes record, set to disabled
            $update_confirm_code = DB::table('confirm_codes')
                ->where('confirm_code', '=', $confirm_code)
                ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                    $query->where('phone', $local_phone)
                          ->where('phone_country', $phone_country);
                }, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->update(['status_id' => $status_disabled]);

            //print_r(DB::getQueryLog());

            //$message = 'Welcome. Your account successfully confirmed.';

            //return ['message' => $message];
            $user = User::where('phone', $local_phone)
                                ->where('phone_country', $phone_country)
                                ->first();
                                
            return $user;

        }

    }

}
