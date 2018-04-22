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

class ApiAccountBalanceController extends BaseController
{

 
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
        "Initiator": "mpesapm",
    "SecurityCredential": "",
    "CommandID": "AccountBalance",
    "PartyA": "",
    "IdentifierType": "4",
    "Remarks": "",
    "QueueTimeOutURL": "",
    "ResultURL": ""

        if ($request->BusinessShortCode) { $BusinessShortCode = $request->BusinessShortCode; } else { $BusinessShortCode = "883305"; }
        if ($request->Amount) { $Amount = $request->Amount; } else { $Amount = "1"; }
        if ($request->PartyA) { $PartyA = $request->PartyA; } else { $PartyA = "254708374149"; }
        if ($request->PhoneNumber) { $PhoneNumber = $request->PhoneNumber; } else { $PhoneNumber = "254708374149"; }
        if ($request->AccountReference) { $AccountReference = $request->AccountReference; } else { $AccountReference = "My Reference"; }
        if ($request->TransactionDesc) { $TransactionDesc = $request->TransactionDesc; } else { $TransactionDesc = "My Trans Desc"; }
        if ($request->Remark) { $Remark = $request->Remark; } else { $Remark = "My Remark"; }
        $TransactionType = "AccountBalance";
        $PartyB = "174379"; 
        $CallBackURL = "https://pendo.co.ke/mpesa/api/mpesa-callback/onlinepayment                                                                                                                                                                               "; 

        $result = $mpesaTransaction->accountBalance($CommandID, $Initiator, $SecurityCredential, $PartyA, $IdentifierType, $Remarks, $QueueTimeOutURL, $ResultURL){
            STKPushQuery($checkoutRequestID, $businessShortCode, $password, $timestamp){

        dd($result);
                        
        return $this->response->created();

    }

}
