<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MpesaAccountBalanceTimeout extends Model
{
    
    /**
     * The attributes that are mass assignable
    **/
    protected $fillable = [
        'id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'user_agent', 'browser', 'browser_version', 'os', 'device', 'src_ip', 'request', 'payload'
    ];

    /*relationships*/

    //start convert dates to local dates
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(getLocalTimezone());
    }


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(getLocalTimezone());
    }
    //end convert dates to local dates


    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function create(array $attributes = [])
    {

        //add user env
        $agent = new \Jenssegers\Agent\Agent;

        $attributes['user_agent'] = serialize($agent);
        $attributes['browser'] = $agent->browser();
        $attributes['browser_version'] = $agent->version($agent->browser());
        $attributes['os'] = $agent->platform();
        $attributes['device'] = $agent->device();
        $attributes['src_ip'] = getIp();
        //end add user env

        //dd($attributes);

        $model = static::query()->create($attributes);

        return $model;

    }


}
