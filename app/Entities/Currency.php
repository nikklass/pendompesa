<?php

namespace App\Entities;
use App\Entities\Account;
use App\Entities\DepositAccount;
use App\Entities\LoanAccount;
use App\Entities\Product;
use App\Entities\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $fillable = [
        'id', 'name', 'initials', 'status_id', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    /*one to many relationship*/
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function depositaccounts()
    {
        return $this->hasMany(DepositkAccount::class);
    }

    public function loanaccounts()
    {
        return $this->hasMany(LoanAccount::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
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


    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function create(array $attributes = [])
    {

        $user_id = auth()->user()->id;

        $attributes['created_by'] = $user_id;
        $attributes['updated_by'] = $user_id;

        $model = static::query()->create($attributes);

        return $model;

    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function updatedata($id, array $attributes = [])
    {

        $user_id = auth()->user()->id;

        $attributes['updated_by'] = $user_id;

        //product data
        $product = static::query()->findOrFail($id);

        //do any extra processing here

        $model = $product->update($attributes);

        return $model;

    }


}
