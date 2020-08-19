<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\SalesManagement\Application\DomainService\Offer\Factory\OfferFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateOfferHandler
{
    private $em;

    private $eventDispatcher;

    private $offerFactory;

    public function __construct(
        OfferFactory $offerFactory,
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher
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