<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Offer;

use Exception;
use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\SalesManagement\Application\DomainService\Offer\Validator\CreateNewOfferInputValidator;
use RealDeal\SalesManagement\Application\Query\GetAllOffersQuery;
use RealDeal\SalesManagement\Application\Query\GetSingleOfferQuery;
use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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
        $validator = new CreateNewOfferInputValidator();
        $violations = $validator->validate($data);

        if(0 !== count($violations)) {
            return $this->returnSerializedViolationsResponse($violations);
        }

        try {
            $command = new CreateOfferCommand(
                $data['name'],
                $data['totalPrice'],
                $data['footage'],
                $data['rooms_number'],
                $data['clientId'],
                $data['contract_type'],
                $data['legal_status'],
                $data['market_type'],
                $data['offering_type'],
                $data['property_type'],
                $data['available_from']
            );

            $this->commandBus->dispatch($command);
            // catch various levels of exception and return detailed response codes
            return new JsonResponse(['name' => $command->getName()], Response::HTTP_CREATED);
        } catch(Exception $exception) {
            return new JsonResponse(json_encode($exception->getMessage()), Response::HTTP_BAD_REQUEST);
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

    private function returnSerializedViolationsResponse(ConstraintViolationListInterface $violations): Response
    {
        $serialized = [];

        foreach ($violations as $violation) {
            $serialized[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return new JsonResponse($serialized, Response::HTTP_CONFLICT);
    }
}
