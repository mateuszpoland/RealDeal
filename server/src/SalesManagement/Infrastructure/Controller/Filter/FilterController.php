<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Filter;

use RealDeal\SalesManagement\Application\Command\Filter\CreateNewClientLooksForPropertyFilterCommand;
use RealDeal\SalesManagement\Application\DomainService\Registry\Filter\Offer\OfferFilterFactoriesRegistry;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use RealDeal\SalesManagement\Application\Query\Filter\GetClientFilterQuery;

class FilterController
{
    private MessageBusInterface $commandBus;
    private ApiResponseBuilder $responseBuilder;
    private OfferFilterFactoriesRegistry $offerFilterFactoriesRegistry;
    private GetClientFilterQuery $getClientFilterQuery;

    public function __construct(
        MessageBusInterface $commandBus,
        ApiResponseBuilder $apiResponseBuilder,
        OfferFilterFactoriesRegistry $offerFilterFactoriesRegistry,
        GetClientFilterQuery $getClientFilterQuery
    )
    {
        $this->commandBus = $commandBus;
        $this->responseBuilder = $apiResponseBuilder;
        $this->offerFilterFactoriesRegistry = $offerFilterFactoriesRegistry;
        $this->getClientFilterQuery = $getClientFilterQuery;
    }

    public function getClientFiltersAction(int $clientId): Response
    {
        $query = $this->getClientFilterQuery->byClientId($clientId);

        return $this->responseBuilder->buildApiSingleResultSerializedResponse($query->execute());
    }

    public function addPropertySearchToClientAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $filters = $data['filters'];
        $clientId = $data['client'];

        try {
            $setOfFilters =  $this->instantiateFilters($filters);
            $command = new CreateNewClientLooksForPropertyFilterCommand($clientId, $setOfFilters);
            $this->commandBus->dispatch($command);

            return new JsonResponse('created', Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return new JsonResponse(json_encode($exception->getMessage()), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getConstraintCollection(): Assert\Collection
    {
        return new Assert\Collection([
            'client_id' => [ new Assert\Type('string'), new Assert\Length(['min' => 1])],
        ]);
    }

    /**
     * @param array $filters - nazwy filtrow
     * @return FilterEnabledInterface[]
     */
    private function instantiateFilters(array $filters): array
    {
        $filtersArray = [];

        foreach ($filters as $filterAlias => $filterArgs) {
            try {
                $filterFactory = $this->offerFilterFactoriesRegistry->getFactory($filterAlias);
                $filter = $filterFactory->create([$filterArgs]);
                $filtersArray[] = $filter;
            } catch (\Exception $exception) {
                // do some logging or sth else
                $violations[] = $exception->getMessage();
            }
        }

        return $filtersArray;
    }
}
