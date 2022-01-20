<?php

namespace App\Models\Filters;

use App\Libraries\Filters\DropdownFilter;
use Illuminate\Database\Eloquent\Builder;

class GenderFilter extends DropdownFilter
{
    /**
     * @var string
     */
    protected $name = 'gender';
    protected $label = 'Gender';

    /**
     * @var string
     */
    protected $vModel = 'query.filters.gender';

    /**
     * @return array
     */
    protected function options(): array
    {
        return [
            'MALE' => 'Male',
            'FEMALE' => 'Female'
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    public function applyFilter(Builder $query, $value): Builder
    {
        return $query->where('gender', $value);
    }
}
