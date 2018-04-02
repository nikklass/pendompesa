<?php

namespace App\Transformers\Ussd;

use App\Company;
use App\Transformers\Company\CompanyTransformer;
use App\UssdRecommend;
use League\Fractal\TransformerAbstract;

/**
 * Class UssdRecommendTransformer
 * @package App\Transformers
 */
class UssdRecommendTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['company'];

    /**
     * @param UssdRecommend $model
     * @return array
     */
    public function transform(UssdRecommend $model)
    {
        
        return [

          'id' => (int)$model->id,
          'full_name' => $model->full_name,
          'phone' => $model->mobile,
          'rec_name' => $model->rec_name,
          'rec_mobile' => $model->rec_mobile,
          'created_at' => formatFriendlyDate($model->created_at),
          'created_at_raw' => $model->created_at,
          'company_id' => $model->company_id
          
        ];
    }


    public function includeCompany(UssdRecommend $model)
    {
        return $this->item($model->company, new CompanyTransformer());
    }

}
