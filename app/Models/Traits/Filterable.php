<?php

namespace App\Models\Traits;

use App\Domain\Customer\Customer;
use App\Domain\Merchant\Merchant;
use App\Domain\User\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Boolean;

trait Filterable
{
    /**
     * Query scope for filterable resource for datatable
     *
     * @param Builder $query
     * @param Request $request
     * @param array $searchColumns
     * @param array $filters
     * @param bool $isMorph
     * @return Builder
     */
    public function scopeFilterResource($query, $request, array $searchColumns = [], array $filters = [], bool $isMorph = false)
    {
        return $query->when($request->filled('search') && count($searchColumns) > 0, function ($query) use ($request, $searchColumns, $isMorph) {
            $query->where(function ($query) use ($request, $searchColumns, $isMorph) {
                foreach ($searchColumns as $column) {
                    if (($pos = strrpos($column, ".")) !== false) {
                        // Nested Search
                        $relation = substr($column, 0, $pos);
                        $nestedKey = substr($column, $pos + 1);
                        if ($isMorph) {
                            $query->orWhereHasMorph($relation, [User::class, Merchant::class, Customer::class], function ($query) use ($nestedKey, $request) {
                                return $query->where($nestedKey, 'like', '%' . $request->search . '%');
                            });
                        } else {
                            $query->orWhereHas($relation, function ($query) use ($nestedKey, $request) {
                                return $query->where($nestedKey, 'like', '%' . $request->search . '%');
                            });
                        }
                    } else {
                        $query->orWhere($this->getTable() . '.' . $column, 'like', '%' . $request->search . '%');
                    }
                }
            });
        })->when(count($filters) > 0, function ($query) use ($request, $filters) {
            $query->where(function ($subQuery) use ($request, $filters) {
                foreach ($filters as $filter) {
                    if ($request->has($filter->paramName())) {
                        $subQuery = $filter->applyFilter($subQuery, $request->input($filter->paramName()));
                    }
                }
            });
        });
    }

    /**
     * Query scope for sorting resource for datatable
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function scopeSortingResource($query, $request)
    {
        return $query->when(Str::contains($request->sort, '.'), function ($query) use ($request) {
            [$relation, $column] = explode(".", $request->sort);
            return $query->orderByRelationship($relation, $column, $request->order);
        }, function ($query) use ($request) {
            return $query->orderBy($request->sort, $request->order);
        });
    }
}
