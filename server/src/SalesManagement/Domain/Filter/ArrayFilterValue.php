<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

class ArrayFilterValue implements FilterValueInterface
{
    private array $filterValue;

    public function __serialize(): array
    {
        return ['filter_value' => $this->filterValue];
    }

    public function __unserialize(array $parameters): self
    {
        $this->filterValue = $parameters['filter_value'];

        return $this;
    }
}
