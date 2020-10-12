<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\PropertyOfferingTypeInterface;

class PropertyOfferingType implements PropertyOfferingTypeInterface
{
    private string $offeringType;

    public function __construct(string $offeringType)
    {
        $this->setOfferingType($offeringType);
    }

    private function setOfferingType(string $offeringType): void
    {
        if(!in_array($offeringType, PropertyOfferingTypeInterface::OFFERING_TYPES)) {
            throw new \InvalidArgumentException('Offering type ' . $offeringType . ' not recognized');
        }
        $this->offeringType = $offeringType;
    }

    public function __toString(): string
    {
        return $this->offeringType;
    }
}
