<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Filter\BoolFilterMustBeEqualOrGreaterThan;
use RealDeal\SalesManagement\Domain\Filter\ElasticFilterInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\Shared\Domain\ValueObject\BaseGreaterThanZeroIntegerValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class RoomsNumber extends BaseGreaterThanZeroIntegerValue implements FilterEnabledInterface
{
    /**
     * @ORM\Column(type="integer", name="rooms_number")
     */
    protected int $value;

    private const VALUE_MODIFIER = 'rooms';

    public function getValueNameModifier()
    {
       return self::VALUE_MODIFIER;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getServiceAlias(): string
    {
        return get_class($this);
    }

    public function getElasticFieldName(): string
    {
        return 'rooms_number';
    }

    public function getFilterableValue(): ElasticFilterInterface
    {
       return (new BoolFilterMustBeEqualOrGreaterThan())->__unserialize([
           'fieldName' => $this->getElasticFieldName(),
           'value'    => $this->getValue()
       ]);
    }

    public function serialize()
    {
        return serialize($this->value);
    }

    public function unserialize($serialized)
    {
        $this->value = unserialize($serialized);
    }
}
