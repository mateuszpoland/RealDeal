<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Event\Client;

class ClientCreatedEvent
{
    private int $clientId;
    private string $clientName;
    private string $clientSecondName;
    private string $clientEmail;
    private string $clientStage;

    public function __construct(
        int $clientId,
        string $clientName,
        string $clientSecondName,
        string $clientEmail,
        string $clientStage
    )
    {
        $this->clientId = $clientId;
        $this->clientName = $clientName;
        $this->clientSecondName = $clientSecondName;
        $this->clientEmail = $clientEmail;
        $this->clientStage = $clientStage;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getClientSecondName(): string
    {
        return $this->clientSecondName;
    }

    public function getClientEmail(): string
    {
        return $this->clientEmail;
    }

    public function getClientStage(): string
    {
        return $this->clientStage;
    }
}
