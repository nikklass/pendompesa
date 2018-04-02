<?php

namespace App\Services\Export\ToExcel;

use App\Entities\PrayerRequest;
use App\Entities\Status;
use App\Services\PrayerRequest\PrayerRequestIndex;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrayerRequestsToExcel 
{

	public function exportExcel($type, $data) {

        //get the data
        $prayerRequestIndex = new PrayerRequestIndex();
        $result = $prayerRequestIndex->getPrayerRequests($data);

        //get all the results
        //$prayerRequests = $result->get();
        $prayerRequests = $result;

        //dd($prayerRequests);

        //if records exist
        if (count($prayerRequests)) {

            //get required columns
            $prayerRequests = $prayerRequests->map(function ($item) {
              return [
                'id' => $item['id'], 
                'full_names' => $item['full_names'],
                'title' => $item['title'],
                'description' => $item['description'],
                'status_id' => $item['status_id'],
                'created_by' => $item['created_by'],
                'created_at' => $item['created_at'],
                'updated_by' => $item['updated_by'],
                'updated_at' => $item['updated_at']
              ];
            });

            $prayerRequest_data_array = [];

            foreach ($prayerRequests as $prayerRequest) {
                
                $user_array = [];

                $prayerRequest_obj = new PrayerRequest($prayerRequest);
                //dd($prayerRequest_obj, $prayerRequest_obj->creator());

                $user_array['id'] = $prayerRequest['id'];
                $user_array['full_names'] = $prayerRequest['full_names'];
                $user_array['phone'] = $prayerRequest_obj->creator->first_name;
                $user_array['title'] = $prayerRequest['title'];
                $user_array['description'] = $prayerRequest_obj->description;
                $user_array['status'] = $prayerRequest_obj->status->name;
                $user_array['created_at'] = $prayerRequest['created_at'];

                $prayerRequest_data_array[] = $user_array;

            }

        } else {

            $prayerRequest_data_array = [];

        }

        //dd($prayerRequest_data_array);

        ////////////////
        //get sheets titles and other data
        $excel_name = "prayer_requests";
        $excel_title = "Prayer Requests";
        $excel_desc = "Prayer Requests";

        //search params - for filtering records based on search criteria
        $start_date = $data->start_date; 
        $end_date = $data->end_date;
        $title = $data->title;
        $status_id = $data->status_id;
        $full_names = $data->full_names;
        $user_id = $data->user_id;

        if ($full_names) {
            $excel_name .= "_full_names_" . $full_names;
            $excel_title .= "_full_names_" . $full_names;
        }

        if ($status_id) {
            $status_data = Status::find($status_id);
            $excel_name .= "_status_" . $status_data->name;
            $excel_title .= "_status_" . $status_data->name;
        }

        if ($title) {
            $excel_name .= "_title_" . $title;
            $excel_title .= "_title_" . $title;
        }

        if ($start_date) {
            //get excel titles
            $excel_name .= "_from_" . $start_at_date;
            $excel_title .= "_from_" . $start_at_date;
        }

        if ($start_date) {
            //get excel titles
            $excel_name .= "_from_" . $start_at_date;
            $excel_title .= "_from_" . $start_at_date;
        }

        if ($end_date) {
            //get excel titles
            $excel_name .= "_to_" . $end_at_date;
            $excel_title .= "_to_" . $end_at_date;
        }

        //end search params 

        //format excel name
        $excel_name = str_slug($excel_name);
        /////////////////

        //dd($prayerRequest_data_array);


        //if mpesaincoming data exists
        if (count($prayerRequest_data_array)) {

            // Initialize the array which will be passed into the Excel generator.
            $prayerRequestArray = []; 

            $prayerRequestArray[] = 
                    ['ID', 'Full Names', 'Phone', 'Title','Description', 'Status', 'Created At'];

            $columns_number = count($prayerRequestArray[0]) - 1; //zero based array search

            // Convert each member of the returned collection into an array,
            // and append it to the array.
            foreach ($prayerRequest_data_array as $prayerRequest_data) {
                $prayerRequestArray[] = (array)$prayerRequest_data;
            }

            // Generate and return the spreadsheet
            $data_array = $prayerRequestArray;
            $data_type = $type;

            //download the file
            downloadExcelFile($excel_name, $excel_title, $excel_desc, $data_array, $data_type, $columns_number);

        }

	}

}
