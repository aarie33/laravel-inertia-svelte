<?php
namespace App\Libraries\Filters;

abstract class DropdownFilterDate extends Filter
{
    /**
     * @var string
     */
    protected $type = 'dropdown';

    /**
     * @var string
     */
    protected $componentName = 'dropdown-filter-date';
}
