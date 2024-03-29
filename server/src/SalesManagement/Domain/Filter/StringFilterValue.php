<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

abstract class StringFilterValue implements ElasticFilterInterface
{
    protected string $filterValue;

    protected string $elasticFieldName;

    public function __serialize(): array
    {
        return [
            'fieldName' => $this->fieldName,
            'value' => $this->filterValue,
        ];
    }

    public function unserialize(array $parameters): self
    {
        $this->filterValue = $parameters['value'];
        $this->elasticFieldName = $parameters['fieldName'];

        return $this;
    }

    abstract public function createElasticQueryFromFilter(): array;
}
