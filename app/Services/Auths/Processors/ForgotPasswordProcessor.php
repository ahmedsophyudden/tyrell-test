<?php

namespace App\Services\Auths\Processors;

use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForgotPasswordProcessor
{

    public function execute(Request $request)
    {

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return ['message' => 'We have e-mailed your password reset link!'];

    }
    
}
