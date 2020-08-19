<?php

namespace RealDeal\SalesManagement\Infrastructure\Controller\Offer;

use Exception;
use InvalidArgumentException;
use RealDeal\SalesManagement\Application\Command\CreateOfferCommand;
use RealDeal\Shared\Infrastructure\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferController
{
    private $commandBus;

    public function __construct(
        CommandBus $commandBus
    )
    {
        $this->commandBus = $commandBus;
    }

    public function addOfferAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $violations = [];
        // validation
        try {
            $command = new CreateOfferCommand(
                $data['name'],
                $data['totalPrice'],
                $data['footage']
            );
            $this->commandBus->handle($command);
            // catch various levels of exception and return detailed response codes
            return new JsonResponse(['name' => $command->getName()], Response::HTTP_CREATED);
        } catch(Exception $exception) {
            $violations[] = $exception->getMessage();
            return new JsonResponse(json_encode($violations), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getAllOffersAction()
    {
        
    }
}