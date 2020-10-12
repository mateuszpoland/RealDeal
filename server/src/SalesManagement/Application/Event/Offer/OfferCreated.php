<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Event\Offer;

class OfferCreated
{
    private int $offerId;
    private string $offerName;
    private float $offerTotalPrice;
    private float $footage;
    private int $clientId;
    private string $propertyContractType;
    private string $propertyLegalStatus;
    private string $propertyMarketType;
    private string $offeringType;
    private \DateTime $availableFrom;

    public function __construct
    (
        int $offerId,
        string $offerName,
        float $offerTotalPrice,
        float $footage,
        int $clientId,
        string $propertyContractType,
        string $propertyLegalStatus,
        string $propertyMarketType,
        string $offeringType,
        \DateTime $availableFrom
    )
    {
        $this->offerId = $offerId;
        $this->offerName = $offerName;
        $this->offerTotalPrice = $offerTotalPrice;
        $this->footage = $footage;
        $this->clientId = $clientId;
        $this->propertyContractType = $propertyContractType;
        $this->propertyLegalStatus = $propertyLegalStatus;
        $this->propertyMarketType = $propertyMarketType;
        $this->offeringType = $offeringType;
        $this->availableFrom = $availableFrom;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getOfferName(): string
    {
        return $this->offerName;
    }

    public function getOfferTotalPrice(): float
    {
        return $this->offerTotalPrice;
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

    public function getFootage(): float
    {
        return $this->footage;
    }

    public function getAvailableFrom(): \DateTime
    {
        return $this->availableFrom;
    }
}
