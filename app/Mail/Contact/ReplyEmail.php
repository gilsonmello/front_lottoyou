<?php

namespace App\Mail\Contact;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contacts.reply_email')
            ->subject('Resposta')
            ->with('contact', $this->contact);
    }
}
