<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\Shared\Domain\ValueObject\BaseGreaterThanZeroIntegerValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class RoomsNumber extends BaseGreaterThanZeroIntegerValue implements FilterEnabledInterface
{
    /**
     * @ORM\Column(type="integer", name="rooms_number")
     */
    protected int $value;

    public const FILTER_ALIAS = 'rooms_number';
    private const VALUE_MODIFIER = 'rooms';

    public function getValueNameModifier()
    {
       return self::VALUE_MODIFIER;
    }

    public function getServiceAlias(): string
    {
        return self::FILTER_ALIAS;
    }
}
