<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Filter\Factory\OfferFilter;

use RealDeal\SalesManagement\Application\DomainService\Filter\Factory\FilterFactoryInterface;
use RealDeal\SalesManagement\Domain\Filter\ValueObject\PriceRange;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

class PriceRangeFilterFactory implements FilterFactoryInterface
{
    private ?array $priceRanges;
    private ?float $requestedPrice;
    private ?float $percent;

    public function __construct()
    {
        $this->priceRanges = null;
        $this->requestedPrice = null;
        $this->percent = null;
    }

    public function create(array $args): FilterEnabledInterface
    {
        $this->validateArgs($args);

        return new PriceRange(
            $this->priceRanges,
            $this->requestedPrice,
        );
    }

    private function validateArgs(array $args): void
    {
        if(!$this->isFirstArgumentAnArrayWithPriceRanges($args) ||
           !$this->isOptionalSecondArgumentAFloatNumber($args)  ||
           !$this->isOptionalThirdArgumentAFloatNumber($args)
        ) {
            throw new \InvalidArgumentException('Invalid arguments provided for filter');
        }
    }

    private function isFirstArgumentAnArrayWithPriceRanges(array $args): bool
    {
        if(!is_array($args[0])) {
            return false;
        }

        $this->priceRanges = $args[0];

        return true;
    }

    private function isOptionalSecondArgumentAFloatNumber(array $args)
    {
        $arg = isset($args[1]) ? $args[1] : null;

        if ($arg && !is_float($arg)){
            return false;
        }

        return true;
    }

    private function isOptionalThirdArgumentAFloatNumber(array $args)
    {
        $arg = isset($args[2]) ? $args[2] : null;

        if ($arg && !is_float($arg)){
            return false;
        }

        return true;
    }
}
