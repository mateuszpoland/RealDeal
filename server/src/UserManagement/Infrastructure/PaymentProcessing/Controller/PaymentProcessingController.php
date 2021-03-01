<?php

declare(strict_types=1);

namespace RealDeal\UserManagement\Infrastructure\PaymentProcessing\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class PaymentProcessingController
{
    private MessageBu
    public function __construct()
    {

    }

    public function buyAccountAction(Request $request): JsonResponse
    {
        return new JsonResponse('payment endpoint', Response::HTTP_OK);
    }
}
