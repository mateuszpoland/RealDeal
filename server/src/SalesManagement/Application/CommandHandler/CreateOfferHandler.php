<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\SalesManagement\Application\DomainService\Offer\OfferFactory;
use RealDeal\SalesManagement\Domain\Offer\Offer;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CreateOfferHandler
{
    private $em;

    private $eventDispatcher;

    private $offerFactory;

    public function __construct(
        OfferFactory $offerFactory,
        EntityManagerInterface $entityManager,
        EventDispatcher $eventDispatcher
    )
    {
        $this->offerFactory = $offerFactory;
        $this->em = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreateOfferCommand $command)
    {
        $offer = $this->offerFactory->create();
        $offer->publishNewOffer(
            $command->getName(),
            $command->getTotalPrice(),
            $command->getFootage()
        );
        $this->em->persist($offer);
        $this->em->flush();

        // raise event - synchronize read model in elasticsearch
        //$event = new OfferCreatedEvent();
        //$this->eventDispatcher->dispatch();
    }
}