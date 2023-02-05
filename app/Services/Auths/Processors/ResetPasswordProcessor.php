<?php

namespace App\Services\Auths\Processors;

use DB;
use Illuminate\Http\Request;

class ResetPasswordProcessor
{

    public function execute(Request $request)
    {
        
        if(!DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first()) throw new Exception('Invalid token!');

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return ['message' => 'Your password has been changed!'];

    }

}
