<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ApiResponseBuilder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function buildElasticResponse(array $elasticRawResult, array $displayFields = []): JsonResponse
    {
        $elasticBuilder = new ElasticResponseBuilder();
        $result = $elasticBuilder->prepareResponse($elasticRawResult, $displayFields);
        $response = new JsonResponse($result, Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    public function buildApiResponse(array $objects): Response
    {
        $normalized = $this->normalizeResultsFromDb($objects);

        return $this->returnJsonResponse($normalized, Response::HTTP_OK);
    }

    public function buildApiSingleResultSerializedResponse($object): Response
    {
        $serialized = $this->serializer
            ->serialize(
                $object,
                'json'
            );
        return new Response($serialized, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    private function normalizeResultsFromDb(array $objects): array
    {
        $normalized = [];
        foreach ($objects as $object) {
            $normalized[] = $this->serializer
                ->normalize(
                    $object,
                    'json'
                );
        }

        return $normalized;
    }

    private function returnJsonResponse(array $normalized, int $httpStatus): JsonResponse
    {
        return new JsonResponse(
            $normalized,
            $httpStatus
        );
    }
}
