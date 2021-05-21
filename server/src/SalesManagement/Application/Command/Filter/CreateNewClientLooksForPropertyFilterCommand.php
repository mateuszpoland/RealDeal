<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command\Filter;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

final class CreateNewClientLooksForPropertyFilterCommand
{
    private int $clientId;
    private array $filters;

    public function __construct(int $clientId, array $filters)
    {
        $this->clientId = $clientId;
        $this->setFilters($filters);
        $this->filters = $filters;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    private function setFilters(array $filters): void
    {
        foreach ($filters as $filter) {
            if(!$filter instanceof FilterEnabledInterface) {
                throw new \Exception('Invalid filter provided');
            }
            $this->filters[] = $filter;
        }
    }
}
