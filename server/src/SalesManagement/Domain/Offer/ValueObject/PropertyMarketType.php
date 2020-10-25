<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

final class PropertyMarketType implements FilterEnabledInterface
{
    public const FILTER_ALIAS = 'property_market_type';
    private const MARKET_TYPES = [
        'aftermarket',
        'primary market'
    ];

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
        return self::FILTER_ALIAS;
    }
}
