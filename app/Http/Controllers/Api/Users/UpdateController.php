<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use App\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Services\Users\Services\UserStore;
use App\Services\Users\DataTransferObjects\UserDto;

class UpdateController extends Controller
{
    private $userStore;

    public function __construct(UserStore $userStore)
    {
        $this->userStore = $userStore;
    }

    public function execute(Request $request)
    {
        $userDto = new UserDto($request);
        $userDto->id = $request->route('id');
        
        return new UserResource($this->userStore->execute($userDto));
    }
}