<?php

namespace App\Entities;

use App\Entities\Company;
use App\User;
use App\Events\SmsOutboxCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SmsOutbox extends Model
{
    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'message', 'short_message', 'phone_number', 'user_id', 'user_agent', 'src_ip', 'src_host', 'status_id', 'sms_type_id', 'company_id', 'schedule_sms_outbox_id', 'group_id', 'delay', 'created_by', 'updated_by'
    ];

    /**
     * Fire events on the model, oncreated, onupdated
     */
    protected $events = [
        'created' => SmsOutboxCreated::class
    ];

    /*one to many relationship*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*one to many relationship*/
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /*one to many relationship*/
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /*one to one relationship*/
    public function scheduleSmsOutbox()
    {
        return $this->belongsTo(ScheduleSmsOutbox::class);
    }


    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function create(array $attributes = [])
    {

        $attributes['phone_number'] = formatPhoneNumber($attributes['phone_number']);
        $attributes['short_message'] = reducelength($attributes['message'],45);
        //add user env
        $attributes['user_agent'] = getUserAgent();
        $attributes['src_ip'] = getIp();
        $attributes['src_host'] = getHost();
        //end add user env

        $model = static::query()->create($attributes);

        return $model;

    }


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

}
