<?php

namespace App\Http\Controllers\Api\Auths;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auths\Processors\LogoutProcessor;

class LogoutController extends Controller
{
    private $logoutProcessor;

    public function __construct(LogoutProcessor $logoutProcessor)
    {
        $this->logoutProcessor = $logoutProcessor;
    }
    
    public function execute(Request $request){
        return $this->logoutProcessor->execute($request);
    }
}