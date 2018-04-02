<?php

namespace App\Http\Controllers\Web\Quote;

use App\Entities\Quote;
use App\Entities\Status;
use App\Http\Controllers\Controller;
use App\Services\Quote\QuoteIndex;
use App\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Session;

class QuoteController extends Controller
{
    
    protected $model;

    /**
     *  constructor.
     *
     * @param Quote $model
     */
    public function __construct(Quote $model)
    {
        $this->model = $model;

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, QuoteIndex $quoteIndex)
    {

        //get the data
        $data = $quoteIndex->getQuotes($request);

        //are we in report mode? return get results
        if ($request->report) {

            $data = $data->get();

        }

        return view('admin.manage.quotes.index', [
            'quotes' => $data->appends(Input::except('page'))
        ]);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $logged_user = auth()->user();
        $statuses = Status::all();
        return view('admin.manage.quotes.create', compact('statuses', 'logged_user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 

        $rules = [
            'title' => 'required',
        ];

        $payload = app('request')->only('title');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        //create item
        $quote = $this->model->create($request->only('title', 'description'));

        Session::flash('success', 'Quote successfully created');

        return redirect()->route('quotes.index');
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = auth()->user();

        //if user is superadmin, proceed, else, abort
        if ($user->hasRole('superadministrator')){

            $quote = $this->model->find($id);

            if ($quote->phone) {
                $phone = getLocalisedPhoneNumber($quote->phone, $quote->phone_country);
                $quote->phone = $phone;
            }

            //dd($quote);
            $statuses = Status::all();

            return view('admin.manage.quotes.edit', compact('quote', 'statuses'));

        } else {

            abort(404);

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
        
        //dd($request);

        $user = auth()->user();

        //if user is superadmin, proceed, else, abort
        if ($user->hasRole('superadministrator')){

            $quote = $this->model->find($id);

            $rules = [
                'title' => 'required',
            ];

            $payload = app('request')->only('title');

            $validator = app('validator')->make($payload, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }

            // update fields
            $this->model->updatedata($id, $request->all());

            Session::flash('success', 'Successfully updated quote - ' . $quote->id);
            //show updated record
            return redirect()->route('quotes.show', $quote->id);

        } else {

            abort(404);

        }

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        //get details for this item
        $quote = $this->model->find($id);

        if ($quote->phone) {
            $phone = getDatabasePhoneNumber($quote->phone, $quote->phone_country);
            $quote->phone = $phone;
        }
        
        return view('admin.manage.quotes.show', compact('quote'));

    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_id = auth()->user()->id;

        $item = $this->model->findOrFail($id);
        
        if ($item) {
            //update deleted by field
            $item->update(['deleted_by' => $user_id]);
            $result = $item->delete();
        }

        return redirect()->route('quotes.index');
    }

}
