<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\Group;
use App\Entities\SmsOutbox;
use App\Role;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                
        return view('site.home');

    }

}
