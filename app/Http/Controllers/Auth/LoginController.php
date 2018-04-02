<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Company;
use App\Entities\ConfirmCode;
use App\Entities\Country;
use App\Entities\SmsOutbox;
use App\Entities\UserLogin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showConfirmForm()
    {
        
        $countries = Country::where('status_id', '1')->get();
        return view('auth.confirm', compact('countries'));

    }

    public function showResendCodeForm()
    {
        
        $countries = Country::where('status_id', '1')->get();
        return view('auth.resendcode', compact('countries'));

    }

    protected function confirm(Request $request)
    {
    
        //start check throttles
        if ($this->hasTooManyLoginAttempts($request)) {
            
            //start save user details if login locked
            $request->merge([
                'status' => 'locked'
            ]); 
            $userlogin = new UserLogin();
            $userlogin = $userlogin->create($request->toArray());
            //end save user details if login locked

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);

        }

        // if user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        //end check throttles

        //////////////////
        //set variables
        $status_active = config('constants.status.active');
        $status_disabled = config('constants.status.disabled');

        $phone_country = $request->phone_country;
        $phone = $request->phone;
        $confirm_code = $request->confirm_code;
        $email = '';
        $local_phone = '';
        $full_phone = '';
        
        //DB::enableQueryLog();

        //check whether entry is an email or not
        // check login field
        $login_type = filter_var( $phone, FILTER_VALIDATE_EMAIL ) ? 'email' : 'phone';
        //dump($login_type);

        if ($login_type == 'email') {
            $email = $phone;
        } else {
            //get user account if active, join to confirm_codes table where status_id = 1
            $local_phone = getLocalisedPhoneNumber($phone, $phone_country);
            $full_phone = getDatabasePhoneNumber($phone, $phone_country);
        }
        
        $user = DB::table('users')
                        ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                            $query->where('users.phone', $local_phone)
                                  ->where('users.phone_country', $phone_country);
                        }, function ($query) use ($email) {
                            $query->where('users.email', $email);
                        })
                        ->first();

        if (!$user) {

            $error = array("phone" => "User account does not exist");
            return redirect()->back()->withInput()->withErrors($error);

        } else {

            if ($user->active == 1) {

                $error = array("phone" => "User account is already active");
                return redirect()->back()->withInput()->withErrors($error);

            } 

            //check if supplied code is active
            $code_data = ConfirmCode::where('confirm_code', '=', $confirm_code)
                            ->where('status_id', '=', $status_active)
                            ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                                $query->where('phone', $local_phone)
                                      ->where('phone_country', $phone_country);
                            }, function ($query) use ($email) {
                                $query->where('email', $email);
                            })
                            ->first();

            //dd($email, $local_phone, $code_data);

            if (!$code_data) {

                $error = array("confirm_code" => "Invalid confirmation code");
                return redirect()->back()->withInput()->withErrors($error);

            } 
            //end check if supplied code is active

            //update the user record
            DB::table('users')
                ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                    $query->where('phone', $local_phone)
                          ->where('phone_country', $phone_country);
                }, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->update(['status_id' => $status_active, 'active' => '1']);

            //update the confirm codes record, set to disabled
            $update_confirm_code = DB::table('confirm_codes')
                ->where('confirm_code', '=', $confirm_code)
                ->when($local_phone, function ($query) use ($local_phone, $phone_country) {
                    $query->where('phone', $local_phone)
                          ->where('phone_country', $phone_country);
                }, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->update(['status_id' => $status_disabled]);

            //print_r(DB::getQueryLog());

            //success, send message back to user
            Session::flash('success', 'Account confirmed successfully. Please login.');
            return redirect()->route('login');
        }
        //////////////////

    }

    protected function confirm2(Request $request)
    {
        
        //dd($request);

        //start check throttles
        if ($this->hasTooManyLoginAttempts($request)) {
            
            //start save user details if login locked
            $request->merge([
                'status' => 'locked'
            ]); 
            $userlogin = new UserLogin();
            $userlogin = $userlogin->create($request->toArray());
            //end save user details if login locked

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);

        }

        // if user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        //end check throttles

        $phone = $request->phone;
        $phone_country = $request->phone_country;
        $code = $request->code;
        $db_phone_number = getDatabasePhoneNumber($phone, $phone_country);
        $local_phone_number = getLocalisedPhoneNumber($phone, $phone_country);

        //check if confirm code exists
        $account_exists = User::where('phone', $local_phone_number)->first();

        //check if confirm code exists
        $code_exists = SmsOutbox::where('message', $code)
                       ->where('phone_number', $db_phone_number)
                       ->first();

        if ($account_exists) {
            
            //proceed
            if ($code_exists) {
                
                //proceed
                //check if code is still active , not expired(4)
                if ($code_exists->status_id != 4) {
                    
                    //proceed
                    //activate account
                    $response = $account_exists->update([
                                    'active'      => '1',
                                    'status_id'   => '1'
                                ]);

                    if ($response) {
                        
                        //success, send message back to user
                        Session::flash('success', 'Account confirmed successfully. Please login.');
                        return redirect()->route('login');

                    } else {

                        //an error occured activating account
                        $error = array("phone" => "An error occured. Please try again.");
                        //$validator->errors()->add('field', 'Something is wrong with this field!');
                        return redirect()->back()->withInput()->withErrors($error);
                        
                    }

                } else {
                    //code expired/ already used
                    $error = array("code" => "The code is invalid. Please request for a new code.");
                    return redirect()->back()->withInput()->withErrors($error);
                }

            } else {
                //code does not exist
                $error = array("code" => "The code is invalid. Please request for a new code.");
                return redirect()->back()->withInput()->withErrors($error);
            }

        } else {

            //account does not exist
            $error = array("phone" => "An error occured. Please try again.");
            return redirect()->back()->withInput()->withErrors($error);

        }

    }


    protected function attemptLogin(Request $request)
    {
        
        $credentials = $this->credentials($request);

        return $this->guard()->attempt(
            $credentials, $request->has('remember')
        );
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        //$this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            
            //start save user details if login locked
            $request->merge([
                'status' => 'locked'
            ]); 
            $userlogin = new UserLogin();
            $userlogin = $userlogin->create($request->toArray());
            //end save user details if login locked

            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);

        }
        // Customization: Validate if client status is active (1)
        if ($this->attemptLogin($request)) {
            
            //start save user details if login succeeded
            $request->merge([
                'status' => 'success'
            ]);
            $userlogin = new UserLogin();
            $userlogin = $userlogin->create($request->toArray());
            //end save user details if login succeeded

            return $this->sendLoginResponse($request);
        }
        // Customization: Validate if user status is active (1)
        $username = $request->get($this->username());
        
        // Customization: It's assumed that username field should be an unique field 
        $user = User::where($this->username, $username)->first();
        //remove $this->username from request object
        unset($request[$this->username]);
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        // Customization: If client status is inactive (0) return failed_status error.
        if ($user) {
            if ($user->status_id !== 1) {
                
                //start save user details if login failed
                $request->merge([
                    'status' => 'failed'
                ]);
                $userlogin = new UserLogin();
                $userlogin = $userlogin->create($request->toArray());
                //end save user details if login failed

                return $this->sendFailedLoginResponse($request, 'auth.failed_status');
            }
        }
        return $this->sendFailedLoginResponse($request);

    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        
        /***************************************/
        // get our login input
        $login = $request->input($this->username());
        // check login field
        $login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'phone';
        // merge our login field into the request with either email or username as key
        $request->merge([ $login_type => $login ]);

        // let's validate and set our credentials
        if ($login_type == 'email') {
            
            //set username local variable
            $this->username = 'email';

            $request->merge([ $this->username => $login ]);
            $this->validate($request, [
                $this->username    => 'required|email',
                'password' => 'required',
            ]);
            $credentials = $request->only( $this->username, 'password' );

        } else {
            
            //set username local variable
            $this->username = 'phone';

            $request->merge([ $this->username => $login ]);
            $this->validate($request, [
                $this->username => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->only( $this->username, 'password' );

        }
        /***************************************/

        // Customization: validate if user status is active (1)
        $credentials['status_id'] = 1;

        return $credentials;

    }

    //customize username
    public function username()
    {
        return 'username';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect('/');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $field
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        $errors = [$this->username() => trans($trans)];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
    * Logout the user
    **/
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }


}
