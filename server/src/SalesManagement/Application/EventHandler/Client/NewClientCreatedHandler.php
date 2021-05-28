<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\EventHandler\Client;

use RealDeal\SalesManagement\Application\Event\Client\ClientCreatedEvent;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NewClientCreatedHandler implements MessageHandlerInterface
{
    private Container $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke(ClientCreatedEvent $event)
    {

    }
}
