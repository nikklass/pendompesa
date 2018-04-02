<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\NewUserConfirm;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendConfirmEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        //if user has email address, send an email to user
        if ($event->user) {

            ///////
            $new_user = $event->user;
            $user_id = $new_user->id;
            $phone_country = $new_user->phone_country;
            $phone = $new_user->phone;
            $email = $new_user->email;
            $first_name = $new_user->first_name;
            $sms_type_id = config('constants.sms_types.registration_sms');

            //start send confirm sms to user *****************//
            $db_phone = getDatabasePhoneNumber($phone, $phone_country);
            $code = generateCode(5);
            $message = "Dear $first_name, this is your account confirmation code: $code";

            //start attempt to send sms
            try {

                //send user sms
                //createSmsOutbox($message, $db_phone, $sms_type_id);

            } catch(\Exception $e) {
                
                log_this($e->getMessage());
                throw new StoreResourceFailedException('Error sending sms - ' . $e);

            }
            //end attempt to send sms

            //start send email if email exists
            if ($event->user->email) {
                
                try {
                    Mail::to($event->user->email)
                    ->send(new NewUserConfirm($event->user));
                } catch(\Exception $e) {
                    log_this($e->getMessage());
                    throw new StoreResourceFailedException('Error sending email - ' . $e);
                }

            }
            //end send email if email exists

            //start store confirm codes
            try {

                //send user sms
                createConfirmCode($code, $sms_type_id, $user_id, $phone, $phone_country, $email);

            } catch(\Exception $e) {
                
                log_this($e->getMessage());
                throw new StoreResourceFailedException('Error saving confirm code - ' . $e);

            }
            //end store confirm codes
            ///////

        }
    }
}
