<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

abstract class ArrayFilterValue implements ElasticFilterInterface
{
    protected array $filterValue;

    protected string $elasticFieldName;

    public function __serialize(): array
    {
        return ['filter_value' => $this->filterValue];
    }

    public function __unserialize(array $parameters): self
    {
        if(!isset($parameters['filter_value']) || !is_array($parameters['filter_value'])) {
            throw new \InvalidArgumentException('Parameters for an array filter should be array.');
        }

        if(!isset($parameters['fieldName'])) {
            throw new \InvalidArgumentException('Missing filter name.');
        }

        $this->filterValue = $parameters['filter_value'];
        $this->elasticFieldName = $parameters['fieldName'];

        return $this;
    }

    abstract public function createElasticFilterQuery(): array;
}
