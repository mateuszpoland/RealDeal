<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class PropertyMarketType
{
    private const MARKET_TYPES = [
        'aftermarket',
        'primary market'
    ];

    /**
     * @ORM\Column(type="string")
     */
    private string $propertyMarketType;

    public function __construct(string $marketType)
    {
        $this->setMarketType($marketType);
    }

    private function setMarketType(string $marketType): void
    {
        if (!in_array($marketType, self::MARKET_TYPES)) {
            throw new \InvalidArgumentException('unrecognized market type: ' . $marketType);
        }
        $this->propertyMarketType = $marketType;
    }

    public function __toString(): string
    {
        return $this->propertyMarketType;
    }

    public function getServiceAlias(): string
    {
        return get_class($this);
    }
}
