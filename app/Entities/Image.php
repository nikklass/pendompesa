<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
	'user' => 'App\User',
	'post' => 'App\Post'
]);

class Image extends Model
{
    /*polymorphic relationship*/
    public function imagetable() {
        return $this->morphTo();
    }
}
