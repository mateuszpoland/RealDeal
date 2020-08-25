<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\SalesManagement\Application\DomainService\Offer\Factory\OfferFactory;
use RealDeal\SalesManagement\Application\Event\Offer\OfferCreated;
use RealDeal\SalesManagement\Application\Repository\Offer\OfferRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateOfferHandler implements MessageHandlerInterface
{
    private $offerRepository;

    /** @var OfferFactory */
    private $offerFactory;

    /** @var Container */
    private $container;

    /** @var MessageBusInterface */
    private $commandBus;

    public function __construct(
        OfferFactory $offerFactory,
        OfferRepository $offerRepository,
        MessageBusInterface $commandBus,
        $container
    )
    {
        $this->container = $container;
        $this->offerFactory = $offerFactory;
        $this->offerRepository = $offerRepository;
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateOfferCommand $command)
    {
        $offer = $this->offerFactory->create();
        $offer->publishNewOffer(
            $command->getName(),
            $command->getTotalPrice(),
            $command->getFootage()
        );

        $this->offerRepository->save($offer);
        // create event and create separate event handler for this
        $event = new OfferCreated(
            $offer->getId(),
            $command->getName(),
            $command->getTotalPrice()
        );

        $this->commandBus->dispatch($event);
    }
}