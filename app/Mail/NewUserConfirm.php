<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class NewUserConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $app_name = config('app.name');
        $first_name = $this->user->first_name;

        return $this->subject(ucfirst($first_name) . ', please confirm ' . $app_name . ' registration')
                        ->markdown('emails.user.newuserconfirm');
    }
}
