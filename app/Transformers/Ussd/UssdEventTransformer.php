<?php

namespace App\Transformers\Ussd;

use App\Company;
use App\Transformers\Company\CompanyTransformer;
use App\Transformers\Ussd\UssdPaymentTransformer;
use App\UssdEvent;
use League\Fractal\TransformerAbstract;

/**
 * Class UssdEventTransformer
 * @package App\Transformers
 */
class UssdEventTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['company'];

    /**
     * @param UssdEvent $model
     * @return array
     */
    public function transform(UssdEvent $model)
    {

        return [

          'id' => (int)$model->id,
          'name' => $model->name,
          'company_id' => $model->company_id,
          'description' => $model->description, 
          'amount' => format_num($model->amount, 0),
          'start_at' => formatFriendlyDate($model->start_at),
          'end_at' => formatFriendlyDate($model->end_at),
          'created_at' => formatFriendlyDate($model->created_at),
          'updated_at' => formatFriendlyDate($model->updated_at),
          'start_at_raw' => $model->start_at,
          'end_at_raw' => $model->end_at,
          'created_at_raw' => $model->created_at,
          'updated_at_raw' => $model->updated_at

        ];
    }

    /**
     * @return \League\Fractal\Resource\Collection
     */
    public function includeCompany(UssdEvent $model)
    {
        return $this->item($model->company, new CompanyTransformer());
    }

}
