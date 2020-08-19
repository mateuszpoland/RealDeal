<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Offer\Factory;
use RealDeal\SalesManagement\Domain\Offer\Offer;

class OfferFactory
{
    public function create(): Offer
    {
        return new Offer();
    }
}