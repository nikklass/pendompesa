<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\Group;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        $id = auth()->user()->id;

        $user = User::where('id', $id)
                ->with('roles')
                ->with('company')
                ->first();
                
        return view('profile.index')->withUser($user);

    }

    public function indexId($id)
    {

        $user = User::where('id', $id)
                ->with('roles')
                ->with('company')
                ->first();

        return view('profile.index')->withUser($user);

    }

    /*show user create form*/
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        //dd($request);

        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'account_number' => 'required',
            'email' => 'email|unique:users',
            'phone_number' => 'required|unique:users'
        ]);



        if (!isValidPhoneNumber($request->phone_number)){
            $message = \Config::get('constants.error.invalid_phone_number');
            Session::flash('error', $message);
            return redirect()->back()->withInput();
        }

        //generate random password
        $password = generateCode(6);

        // create user
        $userData = [
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'email' => request()->email,
            'company_id' => request()->company_id,
            'account_number' => request()->account_number,
            'gender' => request()->gender,
            'phone_number' => formatPhoneNumber(request()->phone_number),
            'password' => bcrypt($password),
            'api_token' => str_random(60),
            'created_by' => request()->user()->id,
            'updated_by' => request()->user()->id
        ];

        $user = User::create($userData);
        
        //add generated password to returned data
        $user['password'] = $password;

        event(new Registered($user));

        session()->flash("success", "User successfully created");
        return $this->registered(request(), $user)
                        ?: redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        return view("users.show")->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {

        $user = User::where('id', $id)
            ->with('roles')
            ->with('groups')
            ->with('company')
            ->first();
        //if user is superadmin, show all companies, else show a user's companies
        if (auth()->user()->hasRole('superadministrator')){
            $companies = Company::all();
        } else {
            $companies = $user->company;
        }
        if (count($companies) < 1) {
            $companies = [];
        }
        //dd($user, $companies);
        
        $groups = [];
        if ($user->company) {
            //get groups
            $groups = $user->company->groups;
        }
        
        if (count($groups) < 1) {
            $groups = [];
        }

        //get all roles
        $roles = Role::all();

        return view("users.edit")
                ->withUser($user)
                ->withRoles($roles)
                ->withGroups($groups)
                ->withCompanies($companies);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:users,email,'.$id,
            'account_number' => 'required',
            'phone_number' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->company_id = $request->company_id;
        $user->phone_number = $request->phone_number;
        $user->account_number = $request->account_number;
        $user->gender = $request->gender;

        if ($request->password_option == 'auto'){
            /*auto generate new password*/
            $password = generateCode(6);
            $user->password = Hash::make($password);
        } else if ($request->password_option == 'manual'){
            /*set to entered password*/
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            if ($request->rolesSelected) {
                //sync roles
                $user->syncRoles(explode(',', $request->rolesSelected));
            }
            if ($request->groupsSelected) {
                //sync groups
                $groups = explode(',', $request->groupsSelected);
                $user->groups()->sync($groups);
            }
            return redirect()->route('users.show', $id);
        } else {
            Session::flash('error', 'There ws an error saving the update');
            return redirect()->route('users.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$user = User::findOrFail($id);
        $user->delete();
        
        return redirect('users.index');*/
    }
}
