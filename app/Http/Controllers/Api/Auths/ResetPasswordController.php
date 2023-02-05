<?php

namespace App\Http\Controllers\Api\AUTH\Authentication;

use App\Http\Controllers\Controller;
use App\Services\Auths\Requests\ResetPasswordRequest;
use App\Services\Auths\Processors\ResetPasswordProcessor;

class ResetPasswordController extends Controller
{
    private $resetPasswordProcessor;

    public function __construct(ResetPasswordProcessor $resetPasswordProcessor)
    {
        $this->resetPasswordProcessor = $resetPasswordProcessor;
    }
    
    public function execute(ResetPasswordRequest $request){
        return $this->resetPasswordProcessor->execute($request);
    }
}