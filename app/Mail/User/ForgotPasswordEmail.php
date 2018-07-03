<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\PasswordReset;

class ForgotPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User $user
     */
    private $user;

    /**
     * PasswordReset $passwordReset
     */
    private $passwordReset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PasswordReset $passwordReset)
    {
        $this->user = $user;
        $this->passwordReset = $passwordReset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.users.forgot_password')
            ->subject(trans('strings.password_recovery'))
            ->with('user', $this->user)
            ->with('password_reset', $this->passwordReset);
    }
}
