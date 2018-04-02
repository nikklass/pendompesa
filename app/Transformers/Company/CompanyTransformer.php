<?php

namespace App\Transformers\Company;

use App\Entities\Company;
use League\Fractal\TransformerAbstract;

/**
 * Class CompanyTransformer
 * @package App\Transformers
 */
class CompanyTransformer extends TransformerAbstract
{

    /**
     * @param Company $model
     * @return array
     */
    public function transform(Company $model)
    {

        return [

          'id' => (int)$model->id,
          'name' => $model->name,
          'description' => $model->description,
          'physical_address' => $model->physical_address,
          'phone' => $model->phone_number,
          'box' => $model->box,
          'email' => $model->email,
          'ussd_code' => $model->ussd_code,
          'sms_user_name' => $model->sms_user_name,
          'latitude' => $model->latitude,
          'longitude' => $model->longitude,
          'created_at' => formatFriendlyDate($model->created_at),
          'updated_at' => formatFriendlyDate($model->updated_at),
          'created_at_raw' => $model->created_at,
          'updated_at_raw' => $model->updated_at,

        ];
    }


}
