<?php

namespace App\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use App\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Services\Users\Services\UserFetch;

class ShowController extends Controller
{
    private $userFetch;

    public function __construct(UserFetch $userFetch)
    {
        $this->userFetch = $userFetch;
    }

    public function execute(Request $request)
    {
        $filters = $request->input('filters');

        if ($request->route('id')) {
            $filters['id'] = $request->route('id');
        }

        $filters['query_method'] = 'first';

        $query = $this->userFetch->execute($filters);
        return new UserResource($query);
    }
}
