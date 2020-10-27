<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

interface FilterValueInterface
{
    public function __serialize(): array;
    public function __unserialize(array $parameters): self;
}
