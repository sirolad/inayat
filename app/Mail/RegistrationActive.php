<?php

namespace Inayat\Mail;

use Inayat\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationActive extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Valid User instance
     * @var Inayat\User
     */
    public $user;

    /**
     * New random  password
     *
     * @var string
     */
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registration');
    }
}
