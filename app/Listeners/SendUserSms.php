<?php

namespace App\Listeners;

use App\Events\SmsOutboxCreated;
use App\Entities\SmsOutbox;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserSms
{
    
    public $model;

    /**
     * Create the event listener.
     *
     * @return void
    */
    public function __construct(SmsOutbox $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param  SmsOutboxCreated  $event
     * @return void
     */
    public function handle(SmsOutboxCreated $event)
    {
        //create a new sms job
        if ($event->sms_outbox) {

            //get message and recipient phone
            $params['sms_message']      = $event->sms_outbox->message;
            $params['phone_number']     = $event->sms_outbox->phone_number;
            //send remote sms here
            $response = sendApiSms($params);

        }
    }
}
