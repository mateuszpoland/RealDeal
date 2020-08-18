<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Offer;

use RealDeal\Shared\Application\AggregateRootFactoryInterface;
use RealDeal\Shared\Domain\AggregateRootInteface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use RealDeal\SalesManagement\Domain\Offer\Offer;

class OfferFactory implements AggregateRootFactoryInterface
{
    public function create(): AggregateRootInteface
    {
        return new Offer();
    }
}