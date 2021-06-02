<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Client;

use RealDeal\SalesManagement\Application\Command\Client\CreateClientCommand;
use RealDeal\SalesManagement\Application\Query\Client\GetSingleClientQuery;
use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\Request;
use RealDeal\SalesManagement\Application\Command\Client\AddProspectivePropertiesToClientCommand;

class ClientController
{
    private MessageBusInterface $commandBus;
    private ApiResponseBuilder $responseBuilder;
    private GetSingleClientQuery $getSingleClient;

    public function __construct(
        MessageBusInterface $commandBus,
        ApiResponseBuilder $apiResponseBuilder,
        GetSingleClientQuery $getSingleClient
    )
    {
        $this->commandBus = $commandBus;
        $this->responseBuilder = $apiResponseBuilder;
        $this->getSingleClient = $getSingleClient;
    }

    public function addClientAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        try{
            $command = new CreateClientCommand(
                $data['name'],
                $data['secondName'],
                $data['email'],
                $data['stage']
            );
            $this->commandBus->dispatch($command);
            return new JsonResponse([], Response::HTTP_CREATED);
        } catch (\Exception $exception){
            return new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addProspectivePropertyToClientAction(Request $request, int $clientId): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
       // $clientId = $data['client_id'];
        $properties = $data['properties'] ?? [];
        try{
            $command = new AddProspectivePropertiesToClientCommand($clientId, $properties);
            $this->commandBus->dispatch($command);
            return new JsonResponse(Response::HTTP_ACCEPTED);
        }catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function removeProspectivePropertyFromClientAction(): JsonResponse
    {
        return new JsonResponse('not yet implemented', Response::HTTP_NO_CONTENT);
    }

    public function getClientAction(int $id): Response
    {
        $query = $this->getSingleClient->byId($id);

        return $this->responseBuilder->buildApiSingleResultSerializedResponse($query->execute());
    }

}
