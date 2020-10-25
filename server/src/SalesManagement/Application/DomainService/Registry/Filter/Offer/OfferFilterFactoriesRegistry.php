<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Registry\Filter\Offer;

use RealDeal\SalesManagement\Application\DomainService\Filter\Factory\FilterFactoryInterface;

final class OfferFilterFactoriesRegistry
{
    private array $filterFactories;

    public function __construct()
    {
        $this->filterFactories = [];
    }

    public function addFilterFactory(FilterFactoryInterface $factory, string $filterInvocationAlias): void
    {
        $this->filterFactories[$filterInvocationAlias] = $factory;
    }

    public function getFactory(string $alias): FilterFactoryInterface
    {
        if(!array_key_exists($alias, $this->filterFactories)) {
            throw new \InvalidArgumentException('No filter factory found for filter alias ' . $alias);
        }

        return $this->filterFactories[$alias];
    }
}
