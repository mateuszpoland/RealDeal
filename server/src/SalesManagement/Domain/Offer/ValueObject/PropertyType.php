<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Filter\ElasticFilterInterface;
use RealDeal\SalesManagement\Domain\Filter\BoolFilterMustMatch;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\PropertyTypeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class PropertyType implements PropertyTypeInterface, FilterEnabledInterface
{
    /**
     * @ORM\Column(type="string")
     */
    private string $propertyType;

    public function __construct(string $propertyType)
    {
        $this->setPropertyType($propertyType);
    }

    private function setPropertyType(string $propertyType): void
    {
        if(!in_array($propertyType, PropertyTypeInterface::PROPERTY_TYPES)) {
            throw new \InvalidArgumentException('Property type ' . $propertyType . ' not recognized');
        }

        $this->propertyType = $propertyType;
    }

    public function getPropertyType(): string
    {
        return $this->propertyType;
    }

    public function __toString(): string
    {
        return $this->propertyType;
    }

    public function getServiceAlias(): string
    {
        return get_class($this);
    }

    public function equals(PropertyTypeInterface $propertyType): bool
    {
        return ((string)$this == (string) $propertyType);
    }

    public function getElasticFieldName(): string
    {
        return 'property_type';
    }

    public function serialize()
    {
        return serialize($this->propertyType);
    }

    public function unserialize($serialized)
    {
        $this->propertyType = unserialize($serialized);
    }

    public function getFilterableValue(): ?ElasticFilterInterface
    {
        return (new BoolFilterMustMatch())->__unserialize([
            'fieldName' => $this->getElasticFieldName(),
            'value'    => $this->propertyType
        ]);
    }
}
