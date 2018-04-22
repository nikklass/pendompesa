<?php

namespace App\Http\Controllers\Api\Mpesa\Callbacks;

use App\Entities\MpesaAccountBalance;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Http\Response\paginator;
use Illuminate\Database\Eloquent\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ApiAccountBalanceCallbackController extends BaseController
{
 
    /**
     * @var MpesaAccountBalance
     */
    protected $model;

    public function __construct(MpesaAccountBalance $model)
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
