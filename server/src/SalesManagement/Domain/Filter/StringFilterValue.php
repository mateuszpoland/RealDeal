<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

class StringFilterValue implements FilterValueInterface
{
    private string $filterValue;

    public function __serialize(): array
    {
        return ['filter_value' => $this->filterValue];
    }

    public function __unserialize(array $serialized): self
    {
        $this->filterValue = $serialized['filter_value'];

        return $this;
    }
}
