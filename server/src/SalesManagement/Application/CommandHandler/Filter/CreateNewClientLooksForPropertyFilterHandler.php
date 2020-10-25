<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler\Filter;

use RealDeal\SalesManagement\Application\Command\Filter\CreateNewClientLooksForPropertyFilterCommand;
use RealDeal\SalesManagement\Application\Repository\Client\ClientRepository;
use RealDeal\SalesManagement\Application\Repository\Filter\OfferSearchRepository;
use RealDeal\SalesManagement\Domain\Filter\Offer\Category\OfferSearch;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateNewClientLooksForPropertyFilterHandler
{
    private ClientRepository $clientRepository;
    private OfferSearchRepository $offerSearchRepository;
    private MessageBusInterface $messageBus;

    public function __construct(
        ClientRepository $clientRepository,
        OfferSearchRepository $offerSearchRepository,
        MessageBusInterface $messageBus
    )
    {
        $this->clientRepository = $clientRepository;
        $this->offerSearchRepository = $offerSearchRepository;
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateNewClientLooksForPropertyFilterCommand $command)
    {
        $filters = $command->getFilters();
        // maybe do some cross-validation between existing client filters (?)
        $client = $this->clientRepository->findById($command->getClientId());
        if(!$client) {
            throw new \InvalidArgumentException('Client not found');
        }
        //
        $filter = OfferSearch::createFromFilters($client, $filters);
        $this->offerSearchRepository->save($filter);

        // dispatch event to amqp - match poperties to clients and generate PropertyMatches out of it.
        $event = new OfferSearchCreatedEvent($filter);
        $this->messageBus->dispatch($event);
    }
}
