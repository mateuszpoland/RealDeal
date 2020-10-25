<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\DependencyInjection\Compiler;

use RealDeal\SalesManagement\Application\DomainService\Registry\Filter\Offer\OfferFilterFactoriesRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OfferFilterFactoryPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if(!$container->has(OfferFilterFactoriesRegistry::class)) {
            throw new \Exception('Missing OfferFilterFactoriesRegistry class');
        }

        $definition = $container->findDefinition(OfferFilterFactoriesRegistry::class);
        $taggedServices = $container->findTaggedServiceIds('factory.filter.offer');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addFilterFactory', [
                   new Reference($id),
                    $attributes['filter_alias']
                ]);
            }
        }
    }
}
