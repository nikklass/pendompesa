<?php

namespace App\Jobs;

use App\SmsOutbox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\User\SmsOutboxStore;

class JobSendUserSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sms_outbox;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1; 

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsOutbox $sms_outbox)
    {
        $this->sms_outbox = $sms_outbox;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SmsOutboxStore $smsOutboxStore)
    {
        
        //send sms outbox
        $sms = $smsOutboxStore->createItem($this->sms_outbox);

    }
}
