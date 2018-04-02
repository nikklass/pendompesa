<?php 

namespace App;

use Carbon\Carbon;
use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
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