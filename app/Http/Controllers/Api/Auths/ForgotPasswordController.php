<?php

namespace App\Http\Controllers\Api\Auths;

use App\Http\Controllers\Controller;
use App\Services\Auths\Requests\ForgotPasswordRequest;
use App\Services\Auths\Processors\ForgotPasswordProcessor;

class ForgotPasswordController extends Controller
{
    private $forgotPasswordProcessor;

    public function __construct(ForgotPasswordProcessor $forgotPasswordProcessor)
    {
        $this->forgotPasswordProcessor = $forgotPasswordProcessor;
    }

    public function execute(ForgotPasswordRequest $request){
        return $this->forgotPasswordProcessor->execute($request);
    }
}