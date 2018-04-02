<?php

namespace App\Transformers\Groups;

use App\Entities\Group;
use League\Fractal\TransformerAbstract;

/**
 * Class GroupTransformer
 * @package App\Transformers
 */
class GroupTransformer extends TransformerAbstract
{

    /**
     * @param Group $model
     * @return array
     */
    public function transform(Group $model)
    {
        return [

            'id' => (int) $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'physical_address' => $model->physical_address,
            'box' => $model->box,
            'phone_number' => $model->phone_number,
            'email' => $model->email,
            'latitude' => $model->latitude,
            'longitude' => $model->longitude,
            'company_id' => $model->company_id,
            'home_ip' => $model->home_ip,
            'created_by' => $model->created_by,
            'updated_by' => $model->updated_by,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at

        ];
    }

}
