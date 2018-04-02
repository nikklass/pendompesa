<?php 

namespace App;

use Carbon\Carbon;
use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
{
	/*protected $fillable = [
	   'name', 'uuid', 'display_name', 'description',
	];*/


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