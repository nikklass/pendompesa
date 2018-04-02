<?php

namespace App\Transformers\Ussd;

use App\Transformers\Ussd\UssdEventTransformer;
use App\UssdEvent;
use App\UssdPayment;
use League\Fractal\TransformerAbstract;

/**
 * Class UssdPaymentTransformer
 * @package App\Transformers
 */
class UssdPaymentTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['ussdevent'];

    /**
     * @param UssdPayment $model
     * @return array
     */
    public function transform(UssdPayment $model)
    {

        return [

          'id' => (int)$model->id,
          'ussd_event_id' => $model->ussd_event_id,
          'amount' => $model->amount,
          'mpesa_trans_id' => $model->mpesa_trans_id,
          'phone' => $model->phone,
          //'user_agent' => $model->user_agent,
          'browser' => $model->browser,
          'browser_version' => $model->browser_version,
          'os' => $model->os,
          'device' => $model->device,
          'src_ip' => $model->src_ip,
          //'created_at' => $model->created_at,
          'created_at' => formatFriendlyDate($model->created_at)

        ];
    }

    /**
     * @param UssdPayment $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUssdevent(UssdPayment $model)
    {
        return $this->item($model->ussdevent, new UssdEventTransformer());
    }

}
