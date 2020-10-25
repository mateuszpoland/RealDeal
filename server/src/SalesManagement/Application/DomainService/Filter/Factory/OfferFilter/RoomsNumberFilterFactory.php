<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Filter\Factory\OfferFilter;

use RealDeal\SalesManagement\Application\DomainService\Filter\Factory\FilterFactoryInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\RoomsNumber;

class RoomsNumberFilterFactory implements FilterFactoryInterface
{
    public function create(array $args): FilterEnabledInterface
    {
        $this->validateArguments($args);

        return new RoomsNumber($args[0]);
    }

    private function validateArguments(array $args): void
    {
        if (!count($args) == 1) {
            throw new \InvalidArgumentException('Too many arguments provided for rooms number filter.');
        }
    }
}
