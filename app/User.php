<?php

namespace App;

use App\Entities\Account;
use App\Entities\ConfirmCode;
use App\Entities\Country;
use App\Entities\DepositAccount;
use App\Entities\Group;
use App\Entities\Image;
use App\Entities\LoanApplication;
use App\Entities\MpesaPaybill;
use App\Entities\PrayerRequest;
use App\Entities\Sacco;
use App\Entities\SmsOutbox;
use App\Entities\State;
use App\Events\UserCreated;
use App\Support\UuidScopeTrait;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Agent\Agent;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable, SoftDeletes, UuidScopeTrait;
    use LaratrustUserTrait;
    
    //protected $appends = ['company'];

    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'first_name', 'uuid', 'user_cd', 'last_name', 'email', 'dob', 'password', 'gender', 'status_id', 'active', 'state_id', 'city_id', 'constituency_id', 'ward_id', 'remember_token', 'access_token', 'refresh_token', 'phone', 'phone_country', 'api_token', 'src_ip', 'user_agent', 'browser', 'browser_version', 'os', 'device', 'dob_updated', 'dob_updated_at', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    /*object events*/
    protected $events = [
    'created' => Events\UserCreated::class,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    protected $dates = ['dob', 'deleted_at', 'dob_updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'access_token', 'refresh_token',
    ];

    /*relation between token and user*/
    public function token() {
        return $this->hasMany(Token::class);
    }

    /* polymorphic relationship \'*/
    public function images() {
        return $this->morphMany(Image::class, 'imagetable');
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimeStamps();
    }

    /*many to many relationship*/
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /*one to many relationship*/
    public function country()
    {
        return $this->belongsTo(Country::class, 'phone_country', 'sortname');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function prayerrequests()
    {
        return $this->hasMany(PrayerRequest::class);
    }

    public function smsOutboxes()
    {
        return $this->hasMany(SmsOutbox::class);
    }

    public function getActiveConfirmCode($phone='', $phone_country='', $email='')
    {
        $status_active = config('constants.status.active');
        $code = ConfirmCode::where('user_id', $this->id)
                ->where('status_id', $status_active)
                ->when($phone, function ($query) use ($phone, $phone_country) {
                    $query->where('phone', $phone)
                          ->where('phone_country', $phone_country);
                }, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->pluck('confirm_code');
        return $code;
    }

    public static function getUser()
    {
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        return $user;
    }

    public function getUserCompanyAttribute()
    {
        $company = Company::findOrFail($this->company_id)->first();
        return $company;
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

    /*get user for passport login*/
    public function findForPassport($username) {

        $status_active = config('constants.status.active');
        return $this->where('active', $status_active)
                    ->where(function ($query) use ($username) {
                        $query->where('email', $username)
                              ->orWhere('phone', $username);
                    })->first();

    }


    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function create(array $attributes = [])
    {

        if (array_key_exists('password', $attributes)) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        //get next user cd
        $attributes['user_cd'] = generate_user_cd();

        //convert phone to standard local phone
        if (array_key_exists('phone', $attributes)) {
            $phone = getLocalisedPhoneNumber($attributes['phone'], $attributes['phone_country']);
            $attributes['phone'] = $phone;
        }

        //generate confirm code
        //$attributes['confirm_code'] = strtoupper(generateCode(5));

        //add user env
        $agent = new \Jenssegers\Agent\Agent;

        $attributes['user_agent'] = serialize($agent);
        $attributes['browser'] = $agent->browser();
        $attributes['browser_version'] = $agent->version($agent->browser());
        $attributes['os'] = $agent->platform();
        $attributes['device'] = $agent->device();
        $attributes['src_ip'] = getIp();
        //end add user env

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

        //user data
        $user = static::query()->findOrFail($id);

        //do any extra processing here

        $model = $user->update($attributes);

        return $model;

    }


}
