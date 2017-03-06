<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContattiMailable extends Mailable
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
        $email = request('email');
        $body = request('message');
        $name = request('name');
        $dest = request('owner_email');
        $phone = request('phone');

        return $this
            ->subject("Modulo Contatti dal Sito halex.it")
            ->to($dest)
            ->view('emails.contatti', compact('email','body','name','phone'));
    }
}
