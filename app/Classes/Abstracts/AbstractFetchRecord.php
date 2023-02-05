<?php

namespace App\Classes\Abstracts;

use ErrorException;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;

use App\Classes\Traits\TraitQueryFilter;

abstract class AbstractFetchRecord
{
    use TraitQueryFilter;

    /** @var array  */
    private const DECORATION_FILTERS = ['query_method', 'per_page', 'order_by', 'group_by'];

    /** @var Collection */
    private $filters;


    /**
     * @return Builder
     */
    abstract function getBuilder(): Builder;

    /**
     * @param array $filters
     * @return mixed
     * @throws ErrorException
     */
    public function execute(array $filters = null)
    {
        try {
            $this->filters = collect($filters);

            return $this->getResults($this->applyFiltersToQuery($this->getBuilder(), $this->getQueryFilters()->toArray()));
        } catch (QueryException $exception) {
            throw new ErrorException('Unable to fetch records due to unexpected error');
        }
    }

    /**
     * @return Collection
     */
    private function getQueryFilters()
    {
        return $this->filters->except(self::DECORATION_FILTERS);
    }

    /**
     * @return Collection
     */
    public function getDecorationFilters()
    {
        return $this->filters->only(self::DECORATION_FILTERS);
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function getResults(Builder $query)
    {
        $filters = $this->getDecorationFilters();

        if ($filters->has('order_by')) {
            foreach ($filters->get('order_by') as $column => $order_type) {
                $query->orderBy($column, $order_type);
            }
        }

        if ($filters->has('group_by')) {
            foreach ($filters->get('group_by') as $column) {
                $query->groupBy($column);
            }
        }

        if ($filters->has('query_method')) {
            return $query->{$filters->get('query_method')}();
        } else {
            if ($filters->has('per_page')) {
                if ($filters->get('per_page') == 'all') {
                    return $query->paginate($query->count());
                } else {
                    return $query->paginate($filters->get('per_page'));
                }
            } else {
                return $query->get();
            }
        }
    }
}
