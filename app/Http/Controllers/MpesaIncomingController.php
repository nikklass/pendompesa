<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\Group;
use App\Entities\MpesaIncoming;
use App\Entities\MpesaPaybill;
use App\User;
use Carbon\Carbon;
use Excel;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Session;

class MpesaIncomingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //get logged in user
        $user = auth()->user();

        //get paybills data sent via url
        $paybills = $request['paybills'];
        $paybills_array = [];

        if ($paybills) { $paybills_array[] = $paybills; }
        
        //get account paybills
        if ($user->hasRole('superadministrator')){
            
            //paybills used to fetch remote data
            if (!count($paybills_array)) {
                //get all paybills
                $paybills_array = MpesaPaybill::pluck('paybill_number')
                        ->toArray();
            }

            //get paybills accounts for showing in dropdown
            $mpesapaybills = MpesaPaybill::all();

        } else if ($user->hasRole('administrator')){
            
            //get user company 
            $user_company_id = $user->company->id;

            //paybills used to fetch remote data
            if (!count($paybills_array)) {
                $paybills_array = MpesaPaybill::where('company_id', $user_company_id)
                        ->pluck('paybill_number')
                        ->toArray();
            }

            //get paybills accounts for showing in dropdown
            $mpesapaybills = MpesaPaybill::where('company_id', $user_company_id)
                        ->get();

        }

        //if records exist
        if (count($paybills_array)) {
            $paybills = implode(',', $paybills_array);
            $request['paybills'] = $paybills;
            
            //get user transactions from paybills
            $mpesaincoming_data = getMpesaPayments($request);

            $mpesaincoming = $mpesaincoming_data->data;
            $paginator_data = $mpesaincoming_data->meta->pagination;
            
            $total = $paginator_data->total;
            $page = $paginator_data->current_page;
            $perPage = $paginator_data->per_page;
            $count = $paginator_data->count;
        } else {
            $mpesaincoming = [];
            $total = "";
            $perPage = 20; 
            $page = 1;
        }

        //paginate incoming results
        $mpesaincoming = new LengthAwarePaginator(
                $mpesaincoming,
                $total, 
                $perPage, 
                $page, 
                ['path'=>url('mpesa-incoming')]
            );

        //return view with appended url params 
        return view('mpesa-incoming.index', [
            'mpesaincoming' => $mpesaincoming->appends(Input::except('page')),
            'mpesapaybills' => $mpesapaybills
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('mpesa-incoming.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
    
        //get details for this mpesaincoming
        $request['id'] = $id;
        $mpesaincoming = getMpesaPayments($request);
        //get first item from array
        $mpesaincoming = $mpesaincoming->data[0]; 
        //dd($mpesaincoming);

        /*+"id": 1340
      +"date_stamp": "2016-10-17 12:34:26"
      +"trans_type": "Pay Bill"
      +"trans_id": "KJH3ZBXKIB"
      +"trans_time": "20161017123410"
      +"orig": "MPESA_API"
      +"ip": null
      +"trans_amount": "1000.00"
      +"biz_no": "871600"
      +"bill_ref": "9601800110"
      +"invoice_no": ""
      +"org_bal": "284587.00"
      +"trans_id3": ""
      +"msisdn": "254725542226"
      +"first_name": "MOHAMED"
      +"middle_name": "JUMA"
      +"last_name": "SIWA"
      +"acc_name": "UNKNOWN"
      +"src_ip": "192.168.9.50"*/
        
        return view('mpesa-incoming.show', compact('mpesaincoming'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $group = Group::where('id', $id)
                 ->with('company')
                 ->first();

        $user = auth()->user();
        //if user is superadmin, show all companies, else show a user's companies
        if ($user->hasRole('superadministrator')){
            $companies = Company::all();
        } else {
            $companies = $user->company;
        }
        
        return view('mpesa-incoming.edit')->withGroup($group)->withCompanies($companies);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'company_id' => 'required|max:255'
        ]);

        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->company_id = $request->company_id;
        $group->phone_number = $request->phone_number;
        $group->email = $request->email;
        $group->physical_address = $request->physical_address;
        $group->box = $request->box;
        $group->updated_by = $user_id;
        $group->save();

        Session::flash('success', 'Successfully updated group - ' . $group->name);
        return redirect()->route('mpesa-incoming.show', $group->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

}
