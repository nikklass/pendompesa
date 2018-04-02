<?php

namespace App\Http\Controllers\Web\Admin;

use App\Entities\Company;
use App\Http\Controllers\Controller;
use App\User;
use App\Entities\UserLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class UserLoginController extends Controller
{
   
    protected $model;

    /**
     * UserLoginController constructor.
     *
     * @param UserLogin $model
     */
    public function __construct(UserLogin $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //get data
        $userlogins = $this->model;

        //filter request
        $id = $request->id;
        $report = $request->report;
        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $start_date = $request->start_date;
        if ($start_date) { 
            $start_date = Carbon::parse($request->start_date); 
            $start_date = $start_date->startOfDay();
        }
        $end_date = $request->end_date;
        if ($end_date) { 
            $end_date = Carbon::parse($request->end_date); 
            $end_date = $end_date->endOfDay();
        }
        
        //filter results
        if ($id) { 
            $userlogins = $userlogins->where('id', $id); 
        }
        if ($user_id) { 
            $userlogins = $userlogins->where('user_id', $user_id); 
        }
        if ($start_date) { 
            $userlogins = $userlogins->where('created_at', '>=', $start_date); 
        }
        if ($end_date) { 
            $userlogins = $userlogins->where('created_at', '<=', $end_date); 
        }

        $userlogins = $userlogins->orderBy('created_at', 'desc');

        if (!$report) {
            
            $userlogins = $userlogins->paginate($request->get('limit', config('app.pagination_limit')));

        } else {
        
            $userlogins = $userlogins->get();

        }
        //end filter request

        //dd($userlogins);

        //return view with appended url params 
        return view('admin.user-logins.index', [
            'userlogins' => $userlogins->appends(Input::except('page'))
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'email' => 'required'
        ]);

        //create item
        $userlogin = $this->model->create($request->all());

        Session::flash('success', 'User login record successfully created');
        
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        //get details
        $userlogin = userlogin::find($id);
        
        return view('admin.user-logins.show', compact('userlogin'));

    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

}
