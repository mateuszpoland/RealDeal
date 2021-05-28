<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Offer;

use Exception;
use Gedmo\Sluggable\Util\Urlizer;
use RealDeal\SalesManagement\Application\Command\Offer\CreateOfferCommand;
use RealDeal\SalesManagement\Application\DomainService\Offer\Validator\CreateNewOfferInputValidator;
use RealDeal\SalesManagement\Application\Query\GetAllOffersQuery;
use RealDeal\SalesManagement\Application\Query\GetSingleOfferQuery;
use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class OfferController
{
    private MessageBusInterface $commandBus;
    private GetAllOffersQuery $getAllOffersQuery;
    private GetSingleOfferQuery $getSingleOffer;
    private ApiResponseBuilder $responseBuilder;
    private Container $serviceContainer;

    public function __construct(
        Container $container,
        MessageBusInterface $commandBus,
        ApiResponseBuilder $responseBuilder,
        GetAllOffersQuery $getAllOffersQuery,
        GetSingleOfferQuery $getSingleOfferQuery
    )
    {
        $this->serviceContainer = $container;
        $this->commandBus = $commandBus;
        $this->getAllOffersQuery = $getAllOffersQuery;
        $this->getSingleOffer = $getSingleOfferQuery;
        $this->responseBuilder = $responseBuilder;
    }

    public function addOfferAction(Request $request)
    {
        /** @var UploadedFile $photos */
        $photos = $request->files->get('photos');
        if($photos) {
            $originalFileName = pathinfo($photos->getClientOriginalName(), PATHINFO_FILENAME);
            $photos->move(
                $this->serviceContainer->getParameter('kernel.project_dir') . '/public/uploads',
                Urlizer::urlize(uniqid('_photo', true) . $originalFileName  . '.' . $photos->guessExtension())
            );
        }
        $data = json_decode($request->request->all()['request'], true);
        $validator = new CreateNewOfferInputValidator();
        $violations = $validator->validate($data);

        if(0 !== count($violations)) {
            return $this->returnSerializedViolationsResponse($violations);
        }

        $data = $photos ? array_merge(['photos' => $photos], $data) : $data;

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
                $data['available_from'],
                $data['photos'] ?? null
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
