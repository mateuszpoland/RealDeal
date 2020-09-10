<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\EventHandler\Offer;

use RealDeal\SalesManagement\Application\Event\Offer\OfferCreated;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OfferCreatedHandler implements MessageHandlerInterface
{
    /** @var */
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke(OfferCreated $event)
    {
        $readOfferModel = new OfferDocument();
        $readOfferModel->setPersistedId($event->getOfferId());
        $readOfferModel->setName($event->getOfferName());
        $readOfferModel->setTotalPrice($event->getOfferTotalPrice());
        $readOfferModel->setClientId($event->getClientId());

        $manager = $this->container->get(OfferDocument::class);

        $manager->persist($readOfferModel);
        $manager->commit();
    }
}