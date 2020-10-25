<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Filter\Factory;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

interface FilterFactoryInterface
{
    public function create(array $args): FilterEnabledInterface;
}
