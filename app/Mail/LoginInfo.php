<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class LoginInfo extends Mailable
{

    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        $email = $this->email;
        $password = $this->password;
        return $this->view('mail.credentials', compact('email', 'password'));
    }
}
