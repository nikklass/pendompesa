<?php

namespace App\Entities;

use App\Entities\Account;
use App\Entities\Country;
use App\Entities\Currency;
use App\Entities\Ebook;
use App\Entities\Product;
use App\Entities\Quote;
use App\Entities\State;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'id', 'name', 'section'
    ];

    public function countries()
    {
        return $this->hasMany(Country::class);
    } 

    public function states()
    {
        return $this->hasMany(State::class);
    } 

    public function ebooks()
    {
        return $this->hasMany(Ebook::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    } 

    public function smsoutboxes()
    {
        return $this->hasMany(SmsOutbox::class);
    } 

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function schedulesmsoutboxes()
    {
        return $this->hasMany(ScheduleSmsOutbox::class);
    }

}
