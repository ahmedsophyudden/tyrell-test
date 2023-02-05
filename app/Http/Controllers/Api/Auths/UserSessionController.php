<?php

namespace App\Http\Controllers\Api\Auths;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSessionController extends Controller
{
    public function __construct()
    {
    }

    public function execute(Request $request){
        $user = $request->user();
        // $user['roles'] = [$currentSession->schoolProfile->getRole()];
        // $user['abilities'] = $currentSession->schoolProfile->getAllAbilities();

        return $user;
    }
}