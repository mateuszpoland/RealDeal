<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Client;

use RealDeal\SalesManagement\Application\Query\Filter\GetClientFilterQuery;
use RealDeal\SalesManagement\Application\Repository\Client\ClientRepository;
use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use RealDeal\SalesManagement\Application\DomainService\Offer\Aggregator\ElasticAggregator;

class OfferMatchController
{
    private ClientRepository $clientRepository;
    private ApiResponseBuilder $responseBuilder;
    private ElasticAggregator $elasticAggregator;
    private GetClientFilterQuery $getClientFilterQuery;

    public function __construct(
        ClientRepository $clientRepository,
        GetClientFilterQuery $getClientFilterQuery,
        ApiResponseBuilder $responseBuilder,
        ElasticAggregator $elasticAggregator
    )
    {
        $this->clientRepository = $clientRepository;
        $this->responseBuilder = $responseBuilder;
        $this->elasticAggregator = $elasticAggregator;
        $this->getClientFilterQuery = $getClientFilterQuery;
    }

    public function getPropertyMatchesForClient(int $clientId): Response
    {
        $client = $this->clientRepository->findById($clientId);
        if(!$client) {
            return $this->responseBuilder->buildErrorResponse();
        }

        // get client filter;
        $clientFilter = $this->getClientFilterQuery->byClientId($clientId)
            ->execute();

        $properties = $this->elasticAggregator->getPropertyMatchesForFilter($clientFilter);
        //$this->createMatches();
        return $this->responseBuilder->buildElasticResponse($properties, []);
    }

    private function createMatches(): array
    {

    }
}
