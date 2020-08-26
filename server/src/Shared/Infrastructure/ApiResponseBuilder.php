<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponseBuilder
{
    public function __construct()
    {
    }

    public function buildElasticResponse(array $elasticRawResult): JsonResponse
    {
        $elasticBuilder = new ElasticResponseBuilder();
        $result = $elasticBuilder->prepareResponse($elasticRawResult);

        return new JsonResponse($result, 200);
    }
}