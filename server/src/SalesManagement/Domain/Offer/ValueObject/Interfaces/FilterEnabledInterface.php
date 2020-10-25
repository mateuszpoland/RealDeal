<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces;

interface FilterEnabledInterface
{
    /**
     * Alias is being used as a key in registry
     * @return string
     */
    public function getServiceAlias(): string;
}
