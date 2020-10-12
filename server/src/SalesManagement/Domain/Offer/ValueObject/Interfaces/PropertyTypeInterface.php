<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces;

interface PropertyTypeInterface
{
    public const PROPERTY_TYPES = [
        self::PROPERTY_TYPE_HOUSE,
        self::PROPERTY_TYPE_FLAT,
        self::PROPERTY_TYPE_LAND,
        self::PROPERTY_TYPE_SERVICE_PREMISES
    ];

    public const PROPERTY_TYPE_HOUSE = 'house';
    public const PROPERTY_TYPE_FLAT = 'flat';
    public const PROPERTY_TYPE_LAND = 'land';
    public const PROPERTY_TYPE_SERVICE_PREMISES = 'service premises';
}
