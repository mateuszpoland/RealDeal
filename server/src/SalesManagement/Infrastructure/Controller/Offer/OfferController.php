<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Offer;

use Exception;
use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\SalesManagement\Application\Query\GetAllOffersQuery;
use RealDeal\SalesManagement\Application\Query\GetSingleOfferQuery;
use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class OfferController
{
    /** @var MessageBusInterface  */
    private $commandBus;

    /** @var GetAllOffersQuery  */
    private $getAllOffersQuery;

    /** @var GetSingleOfferQuery */
    private $getSingleOffer;

    /** @var ApiResponseBuilder  */
    private $responseBuilder;

    public function __construct(
        MessageBusInterface $commandBus,
        ApiResponseBuilder $responseBuilder,
        GetAllOffersQuery $getAllOffersQuery,
        GetSingleOfferQuery $getSingleOfferQuery
    )
    {
        $this->commandBus = $commandBus;
        $this->getAllOffersQuery = $getAllOffersQuery;
        $this->getSingleOffer = $getSingleOfferQuery;
        $this->responseBuilder = $responseBuilder;
    }

    public function addOfferAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $violations = [];
        // validation
        try {
            $command = new CreateOfferCommand(
                $data['name'],
                $data['totalPrice'],
                $data['footage'],
                $data['clientId'],
                $data['contract_type'],
                $data['legal_status'],
                $data['market_type'],
                $data['offering_type'],
            );
            $this->commandBus->dispatch($command);
            // catch various levels of exception and return detailed response codes
            return new JsonResponse(['name' => $command->getName()], Response::HTTP_CREATED);
        } catch(Exception $exception) {
            $violations[] = $exception->getMessage();
            return new JsonResponse(json_encode($violations), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getAllOffersAction(): JsonResponse
    {
        return $this->responseBuilder->buildElasticResponse($this->getAllOffersQuery->execute());
    }

    public function getSingleOfferAction(string $id): JsonResponse
    {
        //$fieldsToDisplay = $this->getConfigForUser->getFieldsToDisplay(); // @todo - make this a query or separate serivce - get config for what to display for user based on his role or what has been set for him by admin
        $query = $this->getSingleOffer->byDocumentId($id);
        return $this->responseBuilder->buildElasticResponse($query->execute());
    }
}
