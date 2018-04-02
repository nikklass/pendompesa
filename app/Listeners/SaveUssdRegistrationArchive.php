<?php

namespace App\Listeners;

use App\Events\UssdRegistrationCreated;
use App\UssdRegistrationArchive;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveUssdRegistrationArchive
{
    
    public $model;

    /**
     * Create the event listener.
     *
     * @return void
    */
    public function __construct(UssdRegistrationArchive $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param  UssdRegistrationCreated  $event
     * @return void
     */
    public function handle(UssdRegistrationCreated $event)
    {
        if ($event->ussd_registration) {
            
            //create ussd_registration archive entry
            $ussd_registration_archive = $this->model->create($event->ussd_registration->toArray());

            return $ussd_registration_archive;

        }
    }

}
