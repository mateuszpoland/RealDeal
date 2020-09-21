<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command\Client;

class AddProspectivePropertiesToClientCommand
{
    private int $clientId;
    private array $propertiesIds;

    public function __construct(
        int $clientId,
        array $propertiesIds
    )
    {
        $this->clientId = $clientId;
        $this->propertiesIds = $propertiesIds;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getPropertiesIds(): array
    {
        return $this->propertiesIds;
    }


}