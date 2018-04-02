<?php

namespace App\Entities;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'description', 'physical_address', 'box', 'phone', 'email', 'latitude', 'longitude'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
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
