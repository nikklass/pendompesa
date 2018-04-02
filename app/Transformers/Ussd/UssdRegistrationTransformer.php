<?php

namespace App\Transformers\Ussd;

use App\Company;
use App\Transformers\Ussd\UssdEventTransformer;
use App\UssdRegistration;
use League\Fractal\TransformerAbstract;

/**
 * Class UssdRegistrationTransformer
 * @package App\Transformers
 */
class UssdRegistrationTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['ussdevent'];

    /**
     * @param UssdRegistration $model
     * @return array
     */
    public function transform(UssdRegistration $model)
    {

        return [

          'id' => (int)$model->id,
          'name' => $model->name,
          'phone' => $model->mobile,
          'alternate_mobile' => $model->alternate_mobile,
          'tsc_no' => $model->tsc_no,
          'email' => $model->email,
          'county' => $model->county,
          'sub_county' => $model->sub_county,
          'workplace' => $model->workplace,
          'ict_level' => $model->ict_level,
          'subjects' => $model->subjects,
          'lipanampesacode' => $model->lipanampesacode,
          'registered' => $model->registered,
          'created_at' => formatFriendlyDate($model->created_at),
          'created_at_raw' => $model->created_at,
          'company_id' => $model->company_id
        ];
    }


    public function includeUssdevent(UssdRegistration $model)
    {
        return $this->item($model->ussdevent, new UssdEventTransformer());
    }

}
