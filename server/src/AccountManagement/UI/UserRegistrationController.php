<?php
declare(strict_types=1);

namespace RealDeal\AccountManagement\UI;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserRegistrationController
{
    public function registerAccountAction(Request $request): JsonResponse
    {
        return new JsonResponse('Endpoint for registration in progress');
    }
}
