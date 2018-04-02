<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\SmsOutbox;
use App\Services\Export\ToExcel\MpesaIncomingToExcel;
use App\Services\Export\ToExcel\PrayerRequestsToExcel;
use App\Services\Export\ToExcel\SmsOutboxExcel;
use App\Services\Export\ToExcel\UssdContactUsToExcel;
use App\Services\Export\ToExcel\UssdEventsToExcel;
use App\Services\Export\ToExcel\UssdPaymentsToExcel;
use App\Services\Export\ToExcel\UssdRecommendsToExcel;
use App\Services\Export\ToExcel\UssdRegistrationToExcel;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    
    //export sms outbox
    public function exportOutboxSmsToExcel($type, SmsOutboxExcel $smsOutboxExcel) {
        $exportedExcel = $smsOutboxExcel->exportExcel($type, request());
    }

    //export mpesa incoming
    public function exportMpesaIncomingToExcel($type, MpesaIncomingToExcel $mpesaIncomingToExcel) {
        $exportedExcel = $mpesaIncomingToExcel->exportExcel($type, request());
    }

    //export ussd registration
    public function exportUssdRegistrationToExcel($type, UssdRegistrationToExcel $ussdRegistrationToExcel) {
        $exportedExcel = $ussdRegistrationToExcel->exportExcel($type, request());
    }

    //export ussd events
    public function exportUssdEventsToExcel($type, UssdEventsToExcel $ussdEventsToExcel) {
        $exportedExcel = $ussdEventsToExcel->exportExcel($type, request());
    }

    //export ussd payments
    public function exportUssdPaymentsToExcel($type, UssdPaymentsToExcel $ussdPaymentsToExcel) {
        $exportedExcel = $ussdPaymentsToExcel->exportExcel($type, request());
    }

    //export ussd recommends
    public function exportUssdRecommendsToExcel($type, UssdRecommendsToExcel $ussdRecommendsToExcel) {
        $exportedExcel = $ussdRecommendsToExcel->exportExcel($type, request());
    }

    //export ussd contact us
    public function exportUssdContactUsToExcel($type, UssdContactUsToExcel $ussdContactUsToExcel) {
        $exportedExcel = $ussdContactUsToExcel->exportExcel($type, request());
    }

    //export prayer requests
    public function exportPrayerRequestsToExcel($type, PrayerRequestsToExcel $prayerRequestsToExcel) {
        $exportedExcel = $prayerRequestsToExcel->exportExcel($type, request());
    }

    //export user logins
    public function exportUserLoginsToExcel($type, PrayerRequestsToExcel $yehuDepositsToExcel) {

        $exportedExcel = $yehuDepositsToExcel->exportExcel($type, request());

    }


}
