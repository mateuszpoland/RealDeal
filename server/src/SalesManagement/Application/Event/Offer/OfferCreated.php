<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Event\Offer;

class OfferCreated
{
    private int $offerId;

    private string $offerName;

    private float $offerTotalPrice;

    private int $clientId;

    public function __construct
    (
        int $offerId,
        string $offerName,
        float $offerTotalPrice,
        int $clientId
    )
    {   
        $this->offerId = $offerId;
        $this->offerName = $offerName;
        $this->offerTotalPrice = $offerTotalPrice;
        $this->clientId = $clientId;
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
}