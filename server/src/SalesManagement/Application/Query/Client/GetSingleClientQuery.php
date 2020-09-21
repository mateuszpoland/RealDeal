<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Query\Client;

use RealDeal\SalesManagement\Application\Repository\Client\ClientRepository;

class GetSingleClientQuery
{
    private ClientRepository $clientRepository;
    private int $id;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function execute()
    {
        $searchParam = null;
        if($this->id) {
            $searchParam = ':id';
        }

        if($searchParam) {
            return $this->clientRepository->findById($this->id);
        }
    }

    public function byId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}