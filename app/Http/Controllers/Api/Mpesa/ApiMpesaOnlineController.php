<?php

namespace App\Http\Controllers\Api\Mpesa;

use App\Services\Mpesa\MpesaTransaction;
use App\Entities\MpesaIncoming;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Transformers\Mpesa\MpesaIncomingTransformer;
use Carbon\Carbon;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Http\Response\paginator;
use Illuminate\Database\Eloquent\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiMpesaOnlineController extends BaseController
{

    //get mpesa incoming payments 
    public function getPayments(Request $request)
    {
        
        //dd($request);
        //generate reports??
        $report = false;

        $invalid_paybill_number_msg = config('constants.error_messages.invalid_paybill_number');

        $paybills_array = [];

        //get url params
        $paybills = $request->paybills;
        
        //get paybills separated by commas, store in array
        if ($paybills) { 
            //trim all whitespaces in array values
            $paybills_array = array_map('trim', explode(',', $paybills)); 

            //check for valid paybill number
            /*foreach ($paybills_array as $element) {
              if (!is_int($element)) {
                // not an integer value, throw error
                throw new ResourceException($invalid_paybill_number_msg);
                break;
              } 
            }*/
        }
        

        $id = $request->id;
        $report = $request->report;
        $phone_number = $request->phone_number;
        $account_name = $request->account_name;
        $start_date = $request->start_date;
        if ($start_date) { $start_date = Carbon::parse($request->start_date); }
        $end_date = $request->end_date;
        if ($end_date) { $end_date = Carbon::parse($request->end_date); }

        //create new mpesa object
        $mpesaIncoming = new MpesaIncoming();
        
        //filter results
        if ($id) { $mpesaIncoming = $mpesaIncoming->where('id', $id); }
        if ($phone_number) { 
            //format the phone number
            $phone_number = formatPhoneNumber($phone_number);
            $mpesaIncoming = $mpesaIncoming->where('msisdn', $phone_number); 
        }
        if ($paybills) { $mpesaIncoming = $mpesaIncoming->whereIn('biz_no', $paybills_array); }
        if ($account_name) { $mpesaIncoming = $mpesaIncoming->where('acc_name', $account_name); }
        if ($start_date) { 
            $mpesaIncoming = $mpesaIncoming->where('date_stamp', '>=', $start_date); 
        }
        if ($end_date) { 
            $mpesaIncoming = $mpesaIncoming->where('date_stamp', '<=', $end_date); 
            //$mpesaIncoming = $mpesaIncoming->where('date_stamp', '=', formatDisplayDate($end_date)); 
        }

        $mpesaIncoming = $mpesaIncoming->orderBy('date_stamp', 'desc');

        if (!$report) {
            $mpesaIncoming = $mpesaIncoming->paginate($request->get('limit', config('app.pagination_limit')));

            return $this->response->paginator($mpesaIncoming, new MpesaIncomingTransformer());
        }
        
        $mpesaIncoming = $mpesaIncoming->get();
        //dd($mpesaIncoming);
        return $this->response->collection($mpesaIncoming, new MpesaIncomingTransformer());

    }

 
    public function store(Request $request, MpesaTransaction $mpesaTransaction)
    {

        /*
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:users,email',
            'phone_number' => 'required|max:13',
            'password' => 'required|min:6|confirmed'
        ];

        $payload = app('request')->only('first_name', 'last_name', 'email', 'phone_number', 'password', 'password_confirmation');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create new trans.', $validator->errors());
        }

        //set user attributes
        $attributes = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => formatPhoneNumber($request->phone_number),
            'email' => $request->email,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'password' => $request->password,
            'src_host' => getUserAgent(),
            'src_ip' => getIp(),
            'created_at' => getCurrentTime()
        ];
        */

        //new mpesa transaction
        if ($request->BusinessShortCode) { $BusinessShortCode = $request->BusinessShortCode; } else { $BusinessShortCode = "174379"; }
        if ($request->Amount) { $Amount = $request->Amount; } else { $Amount = "1"; }
        if ($request->PartyA) { $PartyA = $request->PartyA; } else { $PartyA = "254708374149"; }
        if ($request->PhoneNumber) { $PhoneNumber = $request->PhoneNumber; } else { $PhoneNumber = "254708374149"; }
        if ($request->AccountReference) { $AccountReference = $request->AccountReference; } else { $AccountReference = "My Reference"; }
        if ($request->TransactionDesc) { $TransactionDesc = $request->TransactionDesc; } else { $TransactionDesc = "My Trans Desc"; }
        if ($request->Remark) { $Remark = $request->Remark; } else { $Remark = "My Remark"; }
        $LipaNaMpesaPasskey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType = "CustomerPayBillOnline";
        $PartyB = "174379"; 
        $CallBackURL = "https://pendo.co.ke/mpesa/api/mpesa-callback/onlinepayment                                                                                                                                                                               "; 

        $result = $mpesaTransaction->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA,
                                             $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remark);

        dd($result);
                        
        return $this->response->created();

    }

}
