<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class CreateEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User $user
     */
    private $user;

    /**
     * Create a new message instance.
     * CreateEmail constructor.
     * @param User $user
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
        return $this->view('emails.users.create')
            ->subject(trans('strings.confirmation_of_registration').' '.config('app.name'))
            ->with('user', $this->user);
    }
}
