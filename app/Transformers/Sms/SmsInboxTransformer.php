<?php

namespace App\Transformers\Sms;

use App\Entities\SmsInbox;
use League\Fractal\TransformerAbstract;

/**
 * Class SmsInboxTransformer
 * @package App\Transformers
 */
class SmsInboxTransformer extends TransformerAbstract
{

    /**
     * @param SmsInbox $model
     * @return array
     */
    public function transform(SmsInbox $model)
    {
        return [

            'que_id' => (int) $model->que_id,
            'que_date' => $model->que_date,
            'que_date_fmt' => $model->que_date,
            'source' => $model->source,
            'dest' => $model->dest,
            'msg_text' => $model->msg_text,
            'msg_text_short' => $model->msg_text,
            'date_stamp' => $model->date_stamp,
            'raw_payload' => $model->raw_payload,
            'replied' => $model->replied

        ];
    }

}
