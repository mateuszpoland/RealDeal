<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
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

    public function buildApiSingleResultSerializedResponse($object): Response
    {
        $serialized = $this->serializer
            ->serialize(
                $object,
                'json'
            );
        return new Response($serialized, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}