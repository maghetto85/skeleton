<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrenotationStaffMailable extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    private $body;

    /**
     * Create a new message instance.
     *
     * @param $body
     */
    public function __construct($body)
    {
        //
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Nuova Prenotazione su Halex.it')
            ->view('emails.prenotazioni-staff', ['body' => $this->body]);
    }
}
