<?php

namespace App\ModelFilters\Users;

use Illuminate\Database\Eloquent\Builder;
use App\Classes\Interfaces\InterfaceFilter;

class Id implements InterfaceFilter
{

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder|mixed
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('id', $value);
    }

}