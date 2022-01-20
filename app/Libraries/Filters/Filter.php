<?php
namespace App\Libraries\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter implements \JsonSerializable
{
    protected $name;
    protected $label;
    protected $options;
    protected $type;
    protected $value;
    protected $componentName;
    protected $paramPrefix = 'filter-';

    public function __construct()
    {
        $this->name = $this->name();
        $this->label = $this->label();
    }

    /**
     * @return array
     */
    protected function options() : array
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
    }

    /**
     * @return string
     */
    public function name() : string
    {
        if (! empty($this->name)) {
            return $this->name;
        }
        return class_basename($this);
    }

    /**
     * @return string
     */
    public function label() : string
    {
        if (! empty($this->label)) {
            return $this->label;
        }
        return $this->name();
    }

    /**
     * @return string
     */
    public function paramName(): string
    {
        return $this->paramPrefix . $this->name();
    }

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    abstract public function applyFilter(Builder $builder, $value): Builder;

    /**
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function jsonSerialize() : array
    {
        return [
            'componentName' => $this->componentName,
            'name' => $this->name(),
            'label' => $this->label(),
            'paramName' => $this->paramName(),
            'type' => $this->type,
            'value' => $this->value,
            'options' => collect($this->options())->map(function ($value, $key) {
                return ['name' => $key, 'value' => $value];
            })->values()->all()
        ];
    }
}
