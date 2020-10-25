<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Filter\Factory\OfferFilter;

use RealDeal\SalesManagement\Application\DomainService\Filter\Factory\FilterFactoryInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType;

class PropertyOfferingTypeFilterFactory implements FilterFactoryInterface
{
    public function create(array $args): FilterEnabledInterface
    {
        if(count($args) > 1) {
            throw new \InvalidArgumentException('Too many arguments provided for property offering type filter.');
        }

        $arg = (string)$args[0];
        return new PropertyOfferingType($arg);
    }
}
