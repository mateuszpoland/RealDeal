<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\PropertyTypeInterface;

class PropertyType implements PropertyTypeInterface
{
    private string $propertyType;

    public function __construct(string $propertyType)
    {
        $this->setPropertyType($propertyType);
    }

    private function setPropertyType(string $propertyType): void
    {
        if(!in_array($propertyType, PropertyTypeInterface::PROPERTY_TYPES)) {
            throw new \InvalidArgumentException('Offering type ' . $propertyType . ' not recognized');
        }
        $this->propertyType = $propertyType;
    }

    public function __toString(): string
    {
        return $this->propertyType;
    }
}
