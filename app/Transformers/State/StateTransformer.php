<?php

namespace App\Transformers\State;

use App\Entities\State;
use App\Transformers\Country\CountryTransformer;
use League\Fractal\TransformerAbstract;

/**
 * Class StateTransformer.
 */
class StateTransformer extends TransformerAbstract
{

    /**
     * @var array
     */
    protected $defaultIncludes = ['country'];

    /**
     * @param State $model
     * @return array
     */
    public function transform(State $model)
    {

        $deleted_at = null;

        if ($model->deleted_at) { $deleted_at = $model->deleted_at->toIso8601String(); }

        return [
            'id' => $model->id,
            'name' => $model->name,
            'country_id' => $model->country_id,
            'status_id' => $model->status_id,
            'status' => $model->status()->first(['id', 'name']),           
            'creator' => $model->creator()->first(['id', 'first_name', 'last_name']),
            'updater' => $model->updater()->first(['id', 'first_name', 'last_name']),
            'deleter' => $model->deleter()->first(['id', 'first_name', 'last_name']),
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
            'deleted_at' => $deleted_at
        ];

    }

    public function includeCountry(State $model)
    {
        if ($model->country) {
            return $this->collection($model->country, new CountryTransformer());
        } else {
            return null;
        }
    }

}
