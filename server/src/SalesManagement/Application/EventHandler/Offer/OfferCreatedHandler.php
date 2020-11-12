<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\EventHandler\Offer;

use RealDeal\SalesManagement\Application\Event\Offer\OfferCreated;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;
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
        /**
         *  create elasticsearch read model of created offer
         */
        $readOfferModel = new OfferDocument();
        $readOfferModel->setPersistedId($event->getOfferId());
        $readOfferModel->setName($event->getOfferName());
        $readOfferModel->setTotalPrice($event->getOfferTotalPrice());
        $readOfferModel->setFootage($event->getFootage());
        $readOfferModel->setNumberOfRooms($event->getRoomsNumber());
        $readOfferModel->setOwnerId($event->getClientId());
        $readOfferModel->setPropertyContractType($event->getPropertyContractType());
        $readOfferModel->setPropertyLegalStatus($event->getPropertyLegalStatus());
        $readOfferModel->setPropertyMarketType($event->getPropertyMarketType());
        $readOfferModel->setPropertyOfferingType($event->getOfferingType());
        $readOfferModel->setPropertyType($event->getPropertyType());
        $readOfferModel->setOfferAvailableFrom($event->getAvailableFrom());

        $manager = $this->container->get(OfferDocument::class);

        $manager->persist($readOfferModel);
        $manager->commit();
    }
}
