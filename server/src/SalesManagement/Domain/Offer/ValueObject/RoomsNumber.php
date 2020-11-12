<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Filter\FilterValueInterface;
use RealDeal\SalesManagement\Domain\Filter\FloatFilterValue;
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

    private FilterValueInterface $filterValue;

    public function __construct(int $value)
    {
        parent::__construct($value);

        $this->filterValue = (new FloatFilterValue())->__unserialize(['filter_value' => $this->getValue()]);
    }

    public const FILTER_ALIAS = 'rooms_number';
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
        return self::FILTER_ALIAS;
    }

    public function getFilterableValue(): FilterValueInterface
    {
       return $this->filterValue;
    }
}
