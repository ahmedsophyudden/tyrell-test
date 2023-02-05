<?php

namespace App\Services\Auths\Processors;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutProcessor
{

    public function execute(Request $request)
    {
        
        if (method_exists($request->user()->currentAccessToken(), 'delete')) {
            $request->user()->currentAccessToken()->delete();
        } else {
            Auth::guard('web')->logout();
        }

        return ['message' => 'Token deleted successfully!'];

    }

}
