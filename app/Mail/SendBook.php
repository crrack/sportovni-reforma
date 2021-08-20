<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBook extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.send-book')
            ->from("noreply@sportovni-reforma.cz", "Sportovní reforma")
            ->cc("noreply@sportovni-reforma.cz", "Sportovní reforma")
            ->bcc("noreply@sportovni-reforma.cz", "Sportovní reforma")
            ->replyTo("jakub@sportovni-reforma.cz", "Sportovní reforma")
            ->subject("Brožura");
    }
}
