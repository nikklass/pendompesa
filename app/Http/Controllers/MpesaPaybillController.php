<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\User;
use App\Entities\MpesaPaybill;
use Illuminate\Http\Request;
use Session;

class MpesaPaybillController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mpesapaybills = MpesaPaybill::paginate($request->get('limit', config('app.pagination_limit')));
        //get user accounts
        $users = User::all();
        return view('mpesa-paybills.index', compact('mpesapaybills', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('mpesa-paybills.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //get logged user id
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'paybill_number' => 'required|digits:6|integer|unique:mpesa_paybills',
            'company_id' => 'required|integer',
            'description' => 'sometimes|max:255'
        ]);

        $mpesapaybill = new MpesaPaybill();
        $mpesapaybill->paybill_number = $request->paybill_number;
        $mpesapaybill->name = $request->name;
        $mpesapaybill->type = $request->type;
        $mpesapaybill->till_number = $request->till_number;
        $mpesapaybill->company_id = $request->company_id;
        $mpesapaybill->description = $request->description;
        $mpesapaybill->company_branch_id = $request->company_branch_id;
        $mpesapaybill->created_by = $user_id;
        $mpesapaybill->updated_by = $user_id;
        $mpesapaybill->save();

        Session::flash('success', 'Successfully created Mpesa Paybill ' . $mpesapaybill->paybill_number);
        return redirect()->route('mpesa-paybills.show', $mpesapaybill->id);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mpesapaybill = MpesaPaybill::findOrFail($id);
        return view('mpesa-paybills.show', compact('mpesapaybill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companies = Company::all();
        $mpesapaybill = MpesaPaybill::where('id', $id)->first();
        return view('mpesa-paybills.edit', compact('mpesapaybill', 'companies'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, $id)
    {
        
        //get logged user id
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'paybill_number' => 'required|digits:6|integer|unique:mpesa_paybills,paybill_number,'.$id,
            'company_id' => 'required|integer',
            'type' => 'required',
            'description' => 'sometimes|max:255'
        ]);

        $mpesapaybill = MpesaPaybill::findOrFail($id);
        $mpesapaybill->paybill_number = $request->paybill_number;
        $mpesapaybill->till_number = $request->till_number;
        $mpesapaybill->name = $request->name;
        $mpesapaybill->type = $request->type;
        $mpesapaybill->company_id = $request->company_id;
        $mpesapaybill->company_branch_id = $request->company_branch_id;
        $mpesapaybill->description = $request->description;
        $mpesapaybill->updated_by = $user_id;

        $mpesapaybill->save();

        Session::flash('success', 'Succesfully updated Mpesa Paybill' . $mpesapaybill->paybill_number );
        return redirect()->route('mpesa-paybills.show', $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

}
