<?php

namespace App\Http\Controllers\Api\Auths;

use App\Constants\LoginType;
use App\Http\Controllers\Controller;
use App\Services\Auths\Requests\LoginRequest;
use App\Services\Auths\Processors\LoginProcessor;

class LoginController extends Controller
{
    private $loginProcessor;

    public function __construct(LoginProcessor $loginProcessor)
    {
        $this->loginProcessor = $loginProcessor;
    }

    public function execute(LoginRequest $request){
        return $this->loginProcessor->execute($request, LoginType::NORMAL);
    }
}