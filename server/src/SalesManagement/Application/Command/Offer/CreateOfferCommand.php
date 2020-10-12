<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command;

use RealDeal\Shared\Application\CommandInterface;

class CreateOfferCommand implements CommandInterface
{
    private string $name;
    private float $totalPrice;
    private float $footage;
    private int $clientId;
    private string $propertyContractType;
    private string $propertyLegalStatus;
    private string $propertyMarketType;
    private string $offeringType;
    private \DateTime $availableFrom;

    public function __construct(
        string $name,
        float $totalPrice,
        float $footage,
        int $clientId,
        string $propertyContractType,
        string $propertyLegalStatus,
        string $propertyMarketType,
        string $offeringType,
        string $availableFrom
    )
    {
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->footage = $footage;
        $this->clientId = $clientId;
        $this->propertyContractType = $propertyContractType;
        $this->propertyLegalStatus = $propertyLegalStatus;
        $this->propertyMarketType = $propertyMarketType;
        $this->offeringType = $offeringType;
        $this->availableFrom = new \DateTime($availableFrom);
    }

    public function __toString(): string
    {
        return get_class($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getFootage(): float
    {
        return $this->footage;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getPropertyContractType(): string
    {
        return $this->propertyContractType;
    }

    public function getPropertyLegalStatus(): string
    {
        return $this->propertyLegalStatus;
    }

    public function getPropertyMarketType(): string
    {
        return $this->propertyMarketType;
    }

    public function getOfferingType(): string
    {
        return $this->offeringType;
    }

    public function getAvailableFrom(): \DateTime
    {
        return $this->availableFrom;
    }
}
