<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler;

use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\SalesManagement\Application\DomainService\Offer\Factory\OfferFactory;
use RealDeal\SalesManagement\Application\Event\Offer\OfferCreated;
use RealDeal\SalesManagement\Application\Repository\Client\ClientRepository;
use RealDeal\SalesManagement\Application\Repository\Offer\OfferRepository;
use RealDeal\SalesManagement\Domain\Client\Client;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateOfferHandler implements MessageHandlerInterface
{
    private OfferRepository $offerRepository;
    private ClientRepository $clientRepository;
    private OfferFactory $offerFactory;
    private Container $container;
    private MessageBusInterface $commandBus;

    public function __construct(
        OfferFactory $offerFactory,
        OfferRepository $offerRepository,
        ClientRepository $clientRepository,
        MessageBusInterface $commandBus,
        $container
    )
    {
        $this->container = $container;
        $this->clientRepository = $clientRepository;
        $this->offerFactory = $offerFactory;
        $this->offerRepository = $offerRepository;
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateOfferCommand $command)
    {
        $offer = $this->offerFactory->create();
        $client = $this->getClientFromRepository($command->getClientId());
        if(!$client) {
            throw new \InvalidArgumentException('Client of id: ' . $command->getClientId() . ' does not exist.');
        }

        $offer->publishNewOffer(
            $command->getName(),
            $command->getTotalPrice(),
            $command->getFootage(),
            $client,
            $command->getPropertyContractType(),
            $command->getPropertyLegalStatus(),
            $command->getPropertyMarketType(),
            $command->getOfferingType()
        );

        $this->offerRepository->save($offer);

        $event = new OfferCreated(
            $offer->getId(),
            $command->getName(),
            $command->getTotalPrice(),
            $command->getClientId(),
            $command->getPropertyContractType(),
            $command->getPropertyLegalStatus(),
            $command->getPropertyMarketType(),
            $command->getOfferingType(),
        );

        $this->commandBus->dispatch($event);
    }

    private function getClientFromRepository(int $clientId): ?Client
    {
        return $this->clientRepository->findById($clientId);
    }
}
