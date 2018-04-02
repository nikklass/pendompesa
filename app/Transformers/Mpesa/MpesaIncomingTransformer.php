<?php

namespace App\Transformers\Mpesa;

use App\Entities\MpesaIncoming;
use League\Fractal\TransformerAbstract;

/**
 * Class MpesaIncomingTransformer
 * @package App\Transformers
 */
class MpesaIncomingTransformer extends TransformerAbstract
{

    /**
     * @param MpesaIncoming $model
     * @return array
     */
    public function transform($model)
    {
        return [

          'id' => (int)$model->id,
          'date_stamp' => $model->date_stamp,
          'trans_type' => $model->trans_type,
          'trans_id' => $model->trans_id,
          'trans_time' => $model->trans_time,
          'orig' => $model->orig,
          'ip' => $model->ip,
          'trans_amount' => $model->trans_amount,
          'biz_no' => $model->biz_no,
          'bill_ref' => $model->bill_ref,
          'invoice_no' => $model->invoice_no,
          'org_bal' => $model->org_bal,
          'trans_id3' => $model->trans_id3,
          'msisdn' => $model->msisdn,
          'first_name' => $model->first_name,
          'middle_name' => $model->middle_name,
          'last_name' => $model->last_name,
          'acc_name' => $model->acc_name,
          'src_ip' => $model->src_ip,
          'src_host' => $model->src_host,
          'raw_payload' => $model->raw_payload,

        ];
    }

}
