<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler\Client;

use RealDeal\SalesManagement\Application\Command\Client\CreateClientCommand;
use RealDeal\SalesManagement\Application\Repository\Client\ClientRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Application\Event\Client\ClientCreatedEvent;

class CreateClientCommandHandler implements MessageHandlerInterface
{
    private MessageBusInterface $commandBus;
    private Container $container;
    private ClientRepository $clientRepository;

    public function __construct(
        MessageBusInterface $commandBus,
        Container $container,
        ClientRepository $clientRepository
    )
    {
        $this->commandBus = $commandBus;
        $this->container = $container;
        $this->clientRepository = $clientRepository;
    }

    public function __invoke(CreateClientCommand $command)
    {
        $client = new Client();
        $client->setName($command->getName());
        $client->setSecondName($command->getSecondName());
        $client->setEmail($command->getEmail());
        $client->setStage($command->getStage());
        $client->setOwnedProperties($command->getOwnedProperties());

        try{
            $this->clientRepository->save($client);
            $event = new ClientCreatedEvent(
                $client->getId(),
                $client->getName(),
                $client->getSecondName(),
                $client->getEmail(),
                $client->getStage()
            );
            $this->commandBus->dispatch($event);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
