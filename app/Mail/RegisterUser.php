<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUser extends Mailable
{
    use Queueable, SerializesModels;

    private object $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $user)
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
        $this->subject('Confirmação de novo e-mail');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mail.user.registerUser')->with([
                'user' => $this->user
            ]
        );
    }
}
