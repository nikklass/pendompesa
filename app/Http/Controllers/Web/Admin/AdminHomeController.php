<?php

namespace App\Http\Controllers\Web\Admin;

use App\Entities\Company;
use App\Entities\Group;
use App\Entities\SmsOutbox;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class AdminHomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = auth()->user();
        $smsoutboxes = [];

        //get users/ groups
        $users = [];
        $groups = [];

        $groups = Group::orderBy('id', 'desc')
                 ->with('users')
                 ->paginate(10);
    
        $users = User::orderBy('id', 'desc')
                ->with('groups')
                ->paginate(10);

        $smsoutboxes = SmsOutbox::orderBy('id', 'desc')
                ->get();
                //->paginate(10);

        $groups_all = Group::orderBy('id', 'desc')
                 ->get();

        //sms outbox count
        $count_smsoutbox = count($smsoutboxes);
        $user->sms_outbox_count = $count_smsoutbox;
        
        //groups count
        $count_groups = count($groups_all);
        $user->count_groups = $count_groups;
        
        return view('admin.home', compact('smsoutboxes'))
            ->withUser($user)
            ->withUsers($users)
            ->withSmsOutboxes($smsoutboxes)
            ->withGroups($groups);

    }

}
