<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Filter;

use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Constraints as Assert;


class FilterController
{
    private MessageBusInterface $commandBus;
    private ApiResponseBuilder $responseBuilder;

    public function __construct(
        MessageBusInterface $commandBus,
        ApiResponseBuilder $apiResponseBuilder
    )
    {
        $this->commandBus = $commandBus;
        $this->responseBuilder = $apiResponseBuilder;
    }

    public function addPropertySearchToClientAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
    }

    public function addClientSearchToPropertyAction(): JsonResponse
    {
        throw new \Exception('Not implemented');
    }

    public function getConstraintCollection(): Assert\Collection
    {
        return new Assert\Collection([
            'client_id' => [ new Assert\Type('string'), new Assert\Length(['min' => 1])],
        ]);
    }
}
