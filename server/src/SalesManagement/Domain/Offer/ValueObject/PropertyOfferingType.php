<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Filter\FilterValueInterface;
use RealDeal\SalesManagement\Domain\Filter\StringFilterValue;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\PropertyOfferingTypeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class PropertyOfferingType implements
    PropertyOfferingTypeInterface,
    FilterEnabledInterface
{
    public const FILTER_ALIAS = 'property_offering_type';

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $offeringType;

    private StringFilterValue $filterValue;

    public function __construct(string $offeringType)
    {
        $this->setOfferingType($offeringType);

        $this->filterValue = (new StringFilterValue())->__unserialize(['filter_value' => $this->offeringType]);
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

    public function getServiceAlias(): string
    {
        return self::FILTER_ALIAS;
    }

    public function getFilterableValue(): FilterValueInterface
    {
        // TODO: Implement getFilterableValue() method.
    }


}
