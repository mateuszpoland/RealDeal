<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter\Offer\Category;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType;

abstract class OfferSearchCategory
{
    private PropertyOfferingType $propertyOfferingType;
}
