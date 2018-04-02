<?php

namespace App\Services\Export\ToExcel;

use App\Group;
use App\Loan;
use App\User;
use Illuminate\Support\Facades\DB;

class SmsOutboxExcel 
{

	public function exportExcel($type, $data) {
		
        dd($type, $data);	
		
        //get logged in user
        $user = auth()->user();
        $company_name = null;

        //if user is superadmin, show all companies, else show a user's companies
        $companies = [];
        if ($user->hasRole('superadministrator')){
            $companies = Company::all()->pluck('id');
        } else if ($user->hasRole('administrator')) {
            if ($user->company) {
                $companies = $user->company->pluck('id');
                $company_name = $user->company->name;
            }
        }

        //get company smsoutbox
        $users = [];
        $groups = [];

        if ($companies) {

            $smsoutboxes = 

                DB::table('sms_outboxes')
                    ->join('statuses', 'sms_outboxes.status_id', '=', 'statuses.id')
                    ->select(
                                'sms_outboxes.id',
                                'sms_outboxes.message', 
                                'sms_outboxes.phone_number',
                                'statuses.name',
                                'sms_outboxes.created_at'
                            )
                    ->whereIn('sms_outboxes.company_id', $companies)
                    ->orderBy('sms_outboxes.id', 'desc')
                    ->get();

        }

        //if smsoutboxes exist
        if (count($smsoutboxes)) {

            // Initialize the array which will be passed into the Excel
            // generator.
            $smsoutboxesArray = []; 

            // Define the Excel spreadsheet headers
            $smsoutboxesArray[] = ['id', 'message','phone','status','created_at'];

            // Convert each member of the returned collection into an array,
            // and append it to the array.
            foreach ($smsoutboxes as $smsoutbox) {
                $smsoutboxesArray[] = (array)$smsoutbox;
            }

            // Generate and return the spreadsheet
            $excel_name = "sms_outbox_$company_name";
            $excel_title = "Sms Outbox - $company_name";
            $excel_desc = "Sms Outbox data for $company_name";
            $data_array = $smsoutboxesArray;
            $data_type = $type;

            //download the file
            downloadExcelFile($excel_name, $excel_title, $excel_desc, $data_array, $data_type);

        }

	}

}
