<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Company;
use App\Entities\Country;
use App\Http\Controllers\Controller;
use App\Services\User\UserStore;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function showRegistrationForm()
    {

        $countries = Country::where('status_id', '1')->get();
        //dd($countries);
        $companies = Company::all();
        return view('auth.register', compact('companies', 'countries'));

    }


    /**
     * Override registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, UserStore $userStore)
    {
        
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_country' => 'required_with:phone',
            'phone' => 'required|phone:mobile',
            'password' => 'required|min:6|confirmed',
        ]);

        //create user
        $user = $userStore->createItem($request->all());

        Session::flash('success', 'User account successfully created. Please confirm your account.');
        
        return redirect()->route('confirm');

    }
    

}
