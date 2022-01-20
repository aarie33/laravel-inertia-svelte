<?php
namespace App\Libraries\Filters;

abstract class DropdownFilter extends Filter
{
    /**
     * @var string
     */
    protected $type = 'dropdown';

    /**
     * @var string
     */
    protected $componentName = 'dropdown-filter';
}
