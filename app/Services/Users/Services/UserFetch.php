<?php

namespace App\Services\Users\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Classes\Abstracts\AbstractFetchRecord;

class UserFetch extends AbstractFetchRecord
{
    public function __construct()
    {
        self::$filter_module_namespace = 'Users\\';
    }
    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return (new User)->newQuery();
    }



}
