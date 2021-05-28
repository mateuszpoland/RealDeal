<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\EventHandler\Offer;

use RealDeal\SalesManagement\Application\Event\Offer\OfferCreated;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OfferCreatedHandler implements MessageHandlerInterface
{
    private Container $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke(OfferCreated $event)
    {

    }
}
