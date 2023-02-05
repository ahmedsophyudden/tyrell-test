<?php

namespace App\Http\Controllers\Api\Users;

use App\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Services\Users\Services\UserStore;
use App\Services\Users\Requests\UserStoreRequest;
use App\Services\Users\DataTransferObjects\UserDto;

class CreateController extends Controller
{
    private $userStore;

    public function __construct(UserStore $userStore)
    {
        $this->userStore = $userStore;
    }

    public function execute(UserStoreRequest $request)
    {
        return new UserResource($this->userStore->execute(new UserDto($request)));
    }
}
