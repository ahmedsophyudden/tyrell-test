<?php

namespace App\Classes\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

trait TraitQueryFilter
{
    protected static $filter_namespace = 'App\\ModelFilters\\';
    protected static $filter_module_namespace = "";


    protected static function filterNamespace() { return static::$filter_namespace; }

    protected static function filterModuleNamespace() { return static::$filter_module_namespace; }
    
    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function applyFiltersToQuery(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }
        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return static::getFilterNamespace() . static::getFilterModuleNamespace() . Str::studly($name);
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    public static function getFilterNamespace()
    {
        return static::filterNamespace();
    }

    public static function getFilterModuleNamespace()
    {
        return static::filterModuleNamespace();
    }
}
