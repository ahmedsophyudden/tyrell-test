<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use App\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Services\Users\Services\UserFetch;

class ListController extends Controller
{
    private $userFetch;

    public function __construct(UserFetch $userFetch)
    {
        $this->userFetch = $userFetch;
    }

    public function execute(Request $request){
        $query = $this->userFetch->execute($request->input('filters'));
        return UserResource::collection($query);
    }
}