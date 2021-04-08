<?php

declare(strict_types=1);

namespace RealDeal\UserManagement\Application\Payments\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Braintree\Gateway;

class BraintreePaymentProcessor
{
    private $braintreeGateway;

    public function __construct()
    {
        $this->braintreeGateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'gvppd75xt3vk2mv5',
            'publicKey' => 'cw287w73p3bx4fy2',
            'privateKey' => '86a1854e1bec272f6c7da3d30a6a0943'
        ]);
    }

    public function generateClientToken(?string $customerId = null): string
    {
        $tokenGenerateArguments = [];
        if($customerId) {
            $tokenGenerateArguments['customerId'] = $customerId;
        }
        return $this->braintreeGateway->clientToken()->generate($tokenGenerateArguments);
    }

    public function handleThreeDSecureTransaction(): JsonResponse
    {

    }

    public function finalizeTransaction()
    {

    }
}
