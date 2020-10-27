<?php
declare(strict_types=1);


namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 *
 * represents Location in the format supported by OpenStreetMap
 * @ORM\Embeddable()
 */
class Location
{
    public const FILTER_ALIAS = 'preferred_location';

    public function getServiceAlias(): string
    {
        return self::FILTER_ALIAS;
    }

}
