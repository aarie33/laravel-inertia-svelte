<?php
namespace App\Libraries\Filters;

abstract class DropdownFilterYear extends Filter
{
    /**
     * @var string
     */
    protected $type = 'dropdown';

    /**
     * @var string
     */
    protected $componentName = 'dropdown-filter-year';
}
