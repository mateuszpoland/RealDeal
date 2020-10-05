<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

final class PropertyMarketType
{
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
}
