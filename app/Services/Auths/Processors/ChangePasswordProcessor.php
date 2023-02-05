<?php

namespace App\Services\Auths\Processors;

use Hash;
use Illuminate\Http\Request;

class ChangePasswordProcessor
{

    public function execute(Request $request)
    {

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return ['message' => 'Password updated successfully!'];
        
    }

}
