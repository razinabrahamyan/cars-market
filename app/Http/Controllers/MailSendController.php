<?php

namespace App\Http\Controllers;

use App\Mail\UserQuoteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    public function userQuote()
    {
        $request = request()->all();

        Mail::to([$request['email']])->send(new UserQuoteMail([
            'model'          => $request['model'] ?? '',
            'msrp'           => $request['msrp'] ?? '',
            'term'           => $request['term'] ?? '',
            'miles'          => $request['miles'] ?? '',
            'monthlyPayment' => $request['monthlyPayment'] ?? '',
            'image'          => preg_replace('/^\/\//','https://',$request['image']) ?? '',
        ]));
    }
}
