<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseBuilder
{
    public function buildElasticResponse(array $elasticRawResult, array $displayFields = []): JsonResponse
    {
        $elasticBuilder = new ElasticResponseBuilder();
        $result = $elasticBuilder->prepareResponse($elasticRawResult, $displayFields);
        $response = new JsonResponse($result, Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}