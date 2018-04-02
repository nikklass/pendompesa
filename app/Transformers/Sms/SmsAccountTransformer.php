<?php

namespace App\Transformers\Sms;

use App\Entities\SmsAccount;
use League\Fractal\TransformerAbstract;

/**
 * Class SmsAccountTransformer
 * @package App\Transformers
 */
class SmsAccountTransformer extends TransformerAbstract
{

    /**
     * @param User $model
     * @return array
     */
    public function transform($model)
    {
        return [

            'id' => (int) $model->id,
            'username' => $model->username,
            'passwd' => $model->passwd,
            'alphanumeric_id' => $model->alphanumeric_id,
            'fullname' => $model->fullname,
            'rights' => $model->username,
            'active' => $model->passwd,
            'default_sid' => $model->default_sid,
            'default_source' => $model->default_source,
            'relationship' => $model->relationship,
            'home_ip' => $model->home_ip,
            'default_priority' => $model->default_priority,
            'default_dest' => $model->default_dest,
            'default_msg' => $model->default_msg,
            'sms_balance' => $model->sms_balance,
            'routes' => $model->routes,
            'paybill' => $model->paybill,
            'show_ipn' => $model->show_ipn,
            'sms_expiry' => $model->sms_expiry,
            'last_updated' => $model->last_updated

        ];
    }

}
