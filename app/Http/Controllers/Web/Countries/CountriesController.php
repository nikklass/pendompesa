<?php

namespace App\Http\Controllers\Web\Countries;

use App\Entities\Country;
use App\Entities\Status;
use App\Http\Controllers\Controller;
use App\Services\Country\CountryIndex;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Http\Response\paginator;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use Propaganistas\LaravelPhone\PhoneNumber;
use libphonenumber\PhoneNumberFormat;

/**
 * Class CountriesController.
 *
 */
class CountriesController extends Controller
{

    /**
     * @var Country
     */
    protected $model;

    /**
     * CountriesController constructor.
     *
     * @param Country $model
     */
    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    /**
     * Returns the Users resource with the roles relation.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request, CountryIndex $countryIndex)
    {

        //get the data
        $data = $countryIndex->getCountries($request);

        //are we in report mode? return get results
        if ($request->report) {

            $data = $data->get();

        }

        return view('admin.manage.countries.index', [
            'countries' => $data->appends(Input::except('page'))
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $logged_user = auth()->user();
        $statuses = Status::all();
        return view('admin.manage.countries.create', compact('statuses', 'logged_user'));

    }

    public function edit($id)
    {

        $user = auth()->user();

        //if user is superadmin, proceed, else, abort
        if ($user->hasRole('superadministrator')){

            $country = $this->model->find($id);
            $statuses = Status::all();

            return view('admin.manage.countries.edit', compact('country', 'statuses'));

        } else {

            abort(404);

        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {

        //get details for this item
        $country = $this->model->find($id);
        
        return view('admin.manage.countries.show', compact('country'));

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    { 

        $rules = [
            'name' => 'required',
            'sortname' => 'required',
            'phonecode' => 'required',
            'status_id' => 'required',
        ];

        $payload = app('request')->only('name', 'sortname', 'phonecode', 'status_id');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        //create item
        $country = $this->model->create($request->all());

        Session::flash('success', 'Country successfully created');

        return redirect()->route('countries.index');
        
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        
        $user = auth()->user();

        //if user is superadmin, proceed, else, abort
        if ($user->hasRole('superadministrator')){

            $country = $this->model->find($id);

            $rules = [
                'name' => 'required',
                'sortname' => 'required',
                'phonecode' => 'required',
                'status_id' => 'required',
            ];

            $payload = app('request')->only('name', 'sortname', 'phonecode', 'status_id');

            $validator = app('validator')->make($payload, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }

            // update fields
            $this->model->updatedata($id, $request->all());

            Session::flash('success', 'Successfully updated country - ' . $country->name);
            //show updated record
            return redirect()->route('countries.index');

        } else {

            abort(404);

        }

    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     */
    public function destroy(Request $request, $uuid)
    {
        $user = $this->model->byUuid($uuid)->firstOrFail();
        $user->delete();

        return $this->response->noContent();
    }
}
