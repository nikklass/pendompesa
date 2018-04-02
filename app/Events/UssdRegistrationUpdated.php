<?php

namespace App\Events;

use App\UssdRegistration;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UssdRegistrationUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    public $ussd_registration;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UssdRegistration $ussd_registration)
    {
        $this->ussd_registration = $ussd_registration;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
