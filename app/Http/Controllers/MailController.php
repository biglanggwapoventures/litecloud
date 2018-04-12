<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\User;
use Mail;

class MailController extends Controller
{
    public function __invoke()
    {
        Mail::to('adriannatabio@gmail.com')->send(new VerifyAccount(new User));

        echo 'send';
    }
}
