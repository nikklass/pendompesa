<?php

namespace App\Transformers\Ussd;

use App\Company;
use App\Transformers\Company\CompanyTransformer;
use App\UssdContactUs;
use League\Fractal\TransformerAbstract;

/**
 * Class UssdContactUsTransformer
 * @package App\Transformers
 */
class UssdContactUsTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['company'];

    /**
     * @param UssdContactUs $model
     * @return array
     */
    public function transform(UssdContactUs $model)
    {
        
        return [

          'id' => (int)$model->id,
          'message' => $model->message,
          'phone' => $model->mobile,
          'created_at' => formatFriendlyDate($model->created_at),
          'created_at_raw' => $model->created_at,
          'company_id' => $model->company_id

        ];
    }


    public function includeCompany(UssdContactUs $model)
    {
        return $this->item($model->company, new CompanyTransformer());
    }

}
