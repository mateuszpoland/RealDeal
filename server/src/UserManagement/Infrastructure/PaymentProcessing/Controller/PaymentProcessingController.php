<?php

declare(strict_types=1);

namespace RealDeal\UserManagement\Infrastructure\PaymentProcessing\Controller;

use RealDeal\Shared\Infrastructure\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use RealDeal\UserManagement\Application\Payments\Service\BraintreePaymentProcessor;

class PaymentProcessingController
{
    private MessageBusInterface $messageBus;
    private ApiResponseBuilder $responseBuilder;
    private PaymentProcessor $braintreePaymentProcessor;

    public function __construct(MessageBusInterface $messageBus, ApiResponseBuilder $responseBuilder)
    {
        $this->messageBus = $messageBus;
        $this->responseBuilder = $responseBuilder;
        $this->paymentProcessor = new BraintreePaymentProcessor();
    }

    public function buyAccountAction(Request $request): JsonResponse
    {
        $token = $this->paymentProcessor->generateClientToken();
        return new JsonResponse($token, Response::HTTP_OK);
    }

    public function finalizeTransaction(Request $request): JsonResponse
    {
        $data = json_decode($request, true);

    }
}
