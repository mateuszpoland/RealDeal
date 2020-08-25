<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Event\Offer;

use RealDeal\SalesManagement\Domain\Offer\Offer;

class OfferCreated
{
    /** @var int */
    private $offerId;

    /** @var string */
    private $offerName;

    /** @var float */
    private $offerTotalPrice;   

    public function __construct
    (
        int $offerId,
        string $offerName,
        float $offerTotalPrice
    )
    {   
        $this->offerId = $offerId;
        $this->offerName = $offerName;
        $this->offerTotalPrice = $offerTotalPrice;
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
}