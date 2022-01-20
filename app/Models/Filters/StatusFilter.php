<?php

namespace App\Models\Filters;

use App\Libraries\Filters\DropdownFilter;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends DropdownFilter
{
    /**
     * @var string
     */
    protected $name = 'status';
    protected $label = 'Status';

    /**
     * @var string
     */
    protected $vModel = 'query.filters.status';

    /**
     * @return array
     */
    protected function options(): array
    {
        return [
            1 => 'Active',
            0 => 'Inactive'
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    public function applyFilter(Builder $query, $value): Builder
    {
        if ($value) {
            return $query->where('is_active', $value);
        }
        return $query;
    }
}
