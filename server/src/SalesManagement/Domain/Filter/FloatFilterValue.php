<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

abstract class FloatFilterValue implements ElasticFilterInterface
{
    protected float $filterValue;

    protected string $elasticFieldName;

    /**
     * @return array
     */
    public function __serialize(): array
    {
        return [
            'fieldName' => $this->fieldName,
            'value' => $this->filterValue
        ];
    }

    public function __unserialize(array $parameters): self
    {
        $this->filterValue = $parameters['value'];
        $this->elasticFieldName = $parameters['fieldName'];

        return $this;
    }

    abstract public function createElasticFilterQuery(): array;
}
