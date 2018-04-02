<?php

namespace App\Http\Controllers\Web\Users;

use App\Entities\Country;
use App\Entities\Group;
use App\Events\AccountAdded;
use App\Http\Controllers\Controller;
use App\Role;
use App\Services\User\UserConfirm;
use App\Services\User\UserIndex;
use App\User;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;

class UserController extends Controller
{
    
    use RegistersUsers;

    /**
     * @var User
     */
    protected $model;

    /**
     * UsersController constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserIndex $userIndex)
    {
        
        $user = auth()->user();

        //if user is superadmin, show all users
        if ($user->hasRole('superadministrator')){

            //get the data
            $data = $userIndex->getUsers($request);

            //are we in report mode? return get results
            if ($request->report) {

                $data = $data->get();

            }

            //return data
            return view('admin.users.index', [
                'users' => $data->appends(Input::except('page'))
            ]);

        } else {

            abort(503);

        }

    }

    /*show user create form*/
    public function create()
    {
        
        $user = auth()->user();
        $userCompany = User::where('id', $user->id)
            ->with('company')
            ->first();
        //if user is superadmin, show all companies, else show a user's companies
        $companies = [];
        if ($user->hasRole('superadministrator')){
            $companies = Company::all();
        } else {
            $companies = $user->company;
        }
        //dd($companies);

        return view('admin.users.create')
            ->withCompanies($companies)
            ->withUser($userCompany);

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_country' => 'required_with:phone',
            'phone' => 'required|phone',
            'password' => 'required|min:8|confirmed',
        ]);

        //create item
        $user = $this->model->create($request->all());

        session()->flash("success", "User successfully created");
        
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$bulk_sms_data = getBulkSMSData($id);
        dd($bulk_sms_data);*/

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

        $logged_user = auth()->user();
        //if user is superadmin, show all companies, else show a user's companies

        if ($logged_user->hasRole('superadministrator')){
            
            $user = $this->model->where('id', $id)->first();
            $countries = Country::all();
            $groups = Group::all();
            $roles = Role::all();

            return view('admin.users.edit', compact('user', 'roles', 'groups', 'countries'));

        } else {

            abort(503);

        }

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
            'email' => 'sometimes|email|unique:users,email,'.$id,
            'account_number' => 'required',
            'phone_country' => 'required_with:phone',
            'phone_number' => 'required|phone',
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->company_id = $request->company_id;
        $user->phone_number = $phone_number;
        $user->account_number = $request->account_number;
        $user->gender = $request->gender;

        if ($request->password_option == 'auto'){
            /*auto generate new password*/
            $password = generateCode(6);
            $user->password = bcrypt($password);
            //send the user a link to change password

        } else if ($request->password_option == 'manual'){
            /*set to entered password*/
            $user->password = bcrypt($request->password);
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
            
            //dd($user);

            Session::flash('success', 'User was edited successfully');
            return redirect()->route('users.show', $id);

        } else {

            Session::flash('error', 'There ws an error saving the update');
            return redirect()->route('users.edit', $id);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('users.index');
    }

    //confirm user account
    public function accountconfirm(Request $request, UserConfirm $userConfirm)
    {

        $this->validate(request(), [
            'phone_country' => 'required_with:phone',
            'phone' => 'required',
            'confirm_code' => 'required',
        ]);

        //store data
        $user = $userConfirm->accountconfirm($request->all());

        Session::flash('success', 'User account confirmed successfully');
        return redirect()->route('login');
                                
    }


}
