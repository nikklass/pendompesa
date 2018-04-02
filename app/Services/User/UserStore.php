<?php

namespace App\Services\User;

use App\User;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserStore 
{
    
    use Helpers;

    public function createItem($data) {
            
        //current date and time
        $date = Carbon::now();
        $date = getLocalDate($date);
        $date = $date->toDateTimeString();


        DB::beginTransaction();

            //start create user
            try {
                
                //get next account number
                /*$company_id = $new_user->company_id;
                $user_cd = $new_user->user_cd;
                $account_number = generate_account_number($company_id, $user_cd, '', $savings_product_id);

                $acct_attributes['account_no'] = $account_number;
                $acct_attributes['account_name'] = $new_user->first_name . ' ' . $new_user->last_name;
                $acct_attributes['product_id'] = $savings_product_id;
                $acct_attributes['company_id'] = $new_user->company_id;
                $acct_attributes['user_id'] = $new_user->id;

                $user_savings_account = $user_savings_account::create($acct_attributes);*/

                
                $new_user = new User();
                $new_user = $new_user::create($data);

            } catch(\Exception $e) {
                
                DB::rollback();
                throw new StoreResourceFailedException($e);

            }
            //end create user


        DB::commit();

        return $new_user;

    }

}
