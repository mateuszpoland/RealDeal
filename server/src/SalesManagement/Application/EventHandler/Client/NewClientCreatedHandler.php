<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\EventHandler\Client;

use RealDeal\SalesManagement\Application\Event\Client\ClientCreatedEvent;
use RealDeal\SalesManagement\Domain\Client\Read\ClientDocument;
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
        $document = new ClientDocument();
        $document->setClientId($event->getClientId());
        $document->setName($event->getClientName());
        $document->setSecondName($event->getClientSecondName());
        $document->setEmail($event->getClientEmail());
        $document->setStage($event->getClientStage());

        $manager = $this->container->get(ClientDocument::class);

        $manager->persist($document);
        $manager->commit();
    }
}
