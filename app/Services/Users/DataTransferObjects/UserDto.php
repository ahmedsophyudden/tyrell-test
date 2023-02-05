<?php

namespace App\Services\Users\DataTransferObjects;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Abstracts\AbstractDataTransferObject;

class UserDto extends AbstractDataTransferObject
{
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($request){
        parent::__construct($request);
        
        $this->password = $this->requestDatas->password ? bcrypt($this->requestDatas->password) : null;
    }

    protected function model() : Model {
        return new User;
    }
}
