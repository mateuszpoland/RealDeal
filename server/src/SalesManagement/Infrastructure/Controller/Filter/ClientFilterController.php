<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Controller\Filter;

use Symfony\Component\HttpFoundation\JsonResponse;

class ClientFilterController extends FilterController
{
    // 1. dodawanie nowej oferty - po przejsciu do menu sprzedazy, powinno nam wyswietlic
    /**
     * liste klientów, ktorzy spelaniaja okreslone kryteria
     */
    public function addClientSearchToPropertyAction(): JsonResponse
    {

    }
}
