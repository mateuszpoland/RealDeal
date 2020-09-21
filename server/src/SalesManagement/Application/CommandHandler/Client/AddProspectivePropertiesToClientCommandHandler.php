<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler\Client;

use RealDeal\SalesManagement\Application\Command\Client\AddProspectivePropertiesToClientCommand;
use RealDeal\SalesManagement\Application\Repository\Client\ClientRepository;
use RealDeal\SalesManagement\Application\Repository\Offer\OfferRepository;
use RealDeal\SalesManagement\Domain\Client\Client;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddProspectivePropertiesToClientCommandHandler implements MessageHandlerInterface
{
    private ClientRepository $clientRepository;
    private OfferRepository $offerRepository;

    public function __construct(
        ClientRepository $clientRepository,
        OfferRepository $offerRepository
    )
    {
        $this->clientRepository = $clientRepository;
        $this->offerRepository = $offerRepository;
    }

    public function __invoke(AddProspectivePropertiesToClientCommand $command):void
    {
        $client = $this->getClientRecord($command->getClientId());
        if(!$client){
            throw new \Exception('Client with this id does not exist');
        }

        $properties  = $this->offerRepository->findAllByIds($command->getPropertiesIds())
            ->toArray();
        array_walk($properties, function($property) use ($client) {
            $client->addProspectiveProperty($property);
        });

        $this->clientRepository->save($client);

        //notify that set of properties was added to client
        //@todo
    }

    private function getClientRecord(int $clientId): ?Client
    {
        return $this->clientRepository->findById($clientId);
    }
}