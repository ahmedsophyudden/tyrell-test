<?php

namespace App\Http\Controllers\Api\Auths;

use App\Http\Controllers\Controller;
use App\Services\Auths\Requests\ChangePasswordRequest;
use App\Services\Auths\Processors\ChangePasswordProcessor;

class ChangePasswordController extends Controller
{
    private $changePasswordProcessor;

    public function __construct(ChangePasswordProcessor $changePasswordProcessor)
    {
        $this->changePasswordProcessor = $changePasswordProcessor;
    }
    
    public function execute(ChangePasswordRequest $request){
        return $this->changePasswordProcessor->execute($request);
    }
}