<?php

namespace App\Http\Controllers\Api\Mpesa;

use App\Entities\MpesaOnlinePayment;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Http\Response\paginator;
use Illuminate\Database\Eloquent\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ApiMpesaOnlineCallbackController extends BaseController
{
 
    /**
     * @var MpesaOnlinePayment
     */
    protected $model;

    public function __construct(MpesaOnlinePayment $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {

        $payload = $request->getContent();

        $request->merge([
            'payload' => $payload
        ]);

        $request->merge([
            'request' => $request
        ]);
        
        //dd($payload);

        //store data
        $trans = $this->model->create($request->all());
        
        return $this->response->created();

        //return $mpesaTransaction->finishTransaction();

    }

}
