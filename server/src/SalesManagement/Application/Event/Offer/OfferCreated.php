<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Event\Offer;

class OfferCreated
{
    private int $offerId;
    private string $offerName;
    private float $offerTotalPrice;
    private int $clientId;
    private string $propertyContractType;
    private string $propertyLegalStatus;
    private string $propertyMarketType;
    private string $offeringType;

    public function __construct
    (
        int $offerId,
        string $offerName,
        float $offerTotalPrice,
        int $clientId,
        string $propertyContractType,
        string $propertyLegalStatus,
        string $propertyMarketType,
        string $offeringType
    )
    {
        $this->offerId = $offerId;
        $this->offerName = $offerName;
        $this->offerTotalPrice = $offerTotalPrice;
        $this->clientId = $clientId;
        $this->propertyContractType = $propertyContractType;
        $this->propertyLegalStatus = $propertyLegalStatus;
        $this->propertyMarketType = $propertyMarketType;
        $this->offeringType = $offeringType;
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
}
