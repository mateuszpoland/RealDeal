<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Offer\Aggregator;

use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;
use Symfony\Component\DependencyInjection\Container;

class ElasticAggregator
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getPropertyMatchesForFilter(OfferSearch $offerSearch): array
    {
        $indexService = $this->container->get(OfferDocument::class);

    }
}
