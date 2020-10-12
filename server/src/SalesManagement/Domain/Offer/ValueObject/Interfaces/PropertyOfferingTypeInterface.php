<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces;


interface PropertyOfferingTypeInterface
{
    public const OFFERING_TYPES = [
        self::OFFERING_TYPE_SALES,
        self::OFFERING_TYPE_LONG_TERM_LET,
        self::OFFERING_TYPE_SHORT_TERM_LET
    ];

    public const OFFERING_TYPE_SALES = 'sales';
    public const OFFERING_TYPE_LONG_TERM_LET = 'long-term-let';
    public const OFFERING_TYPE_SHORT_TERM_LET = 'short-term-let';
}
