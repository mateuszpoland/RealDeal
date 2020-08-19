<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

class UniqueOfferIdentifier
{
    public function __toString(): string
    {
        return uniqid("offer_", true);
    }
}