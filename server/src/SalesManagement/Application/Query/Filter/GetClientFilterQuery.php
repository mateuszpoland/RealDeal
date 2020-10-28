<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Query\Filter;

use RealDeal\SalesManagement\Application\Repository\Filter\OfferSearchRepository;

final class GetClientFilterQuery
{
    private OfferSearchRepository $offerSearchRepository;
    private ?int $clientId;

    public function __construct(OfferSearchRepository $offerSearchRepository)
    {
        $this->offerSearchRepository = $offerSearchRepository;
        $this->clientId = null;
    }

    public function execute()
    {
        if($this->clientId) {
            return $this->executeSearchByClientId();
        }

        return null;
    }

    public function byClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    private function executeSearchByClientId()
    {
       return $this->offerSearchRepository->findForClient($this->clientId);
    }
}
