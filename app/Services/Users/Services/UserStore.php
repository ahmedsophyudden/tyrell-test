<?php

namespace App\Services\Users\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Abstracts\AbstractStoreService;
use App\Classes\Abstracts\AbstractDataTransferObject;
use App\Services\Users\DataTransferObjects\UserDto;

class UserStore extends AbstractStoreService
{
    protected function model() : Model {
        return new User;
    }

    protected function dataTransferObject() : AbstractDataTransferObject {
        return new UserDto([]);
    }
}
