<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;


class PropertyOfferingType
{
    private const OFFERING_TYPES = [
        'sales',
        'long-term-lend',
        'short-term-lend'
    ];

    private string $offeringType;

    public function __construct(string $offeringType)
    {
        $this->setOfferingType($offeringType);
    }

    private function setOfferingType(string $offeringType): void
    {
        if(!in_array($offeringType, self::OFFERING_TYPES)) {
            throw new \InvalidArgumentException('Offering type ' . $offeringType . ' not recognized');
        }
        $this->offeringType = $offeringType;
    }

    public function __toString(): string
    {
        return $this->offeringType;
    }
}
