<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces;

use RealDeal\SalesManagement\Domain\Filter\FilterValueInterface;

interface FilterEnabledInterface
{
    /**
     * Alias is being used as a key in registry
     * @return string
     */
    public function getServiceAlias(): string;

    public function getFilterableValue(): FilterValueInterface;
}
