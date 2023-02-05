<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\Services\UserDelete;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    private $userDelete;

    public function __construct(UserDelete $userDelete)
    {
        $this->userDelete = $userDelete;
    }

    public function execute(Request $request){
        return $this->userDelete->execute($request->route('id'));
    }
}