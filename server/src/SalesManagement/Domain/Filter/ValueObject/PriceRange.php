<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter\ValueObject;


use RealDeal\SalesManagement\Domain\Filter\ArrayFilterValue;
use RealDeal\SalesManagement\Domain\Filter\FilterValueInterface;
use RealDeal\SalesManagement\Domain\Filter\FloatFilterValue;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Price;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

class PriceRange implements FilterEnabledInterface
{
    private const FILTER_ALIAS = 'price_range';
    private const PRICE_RANGE_TOLERANCE = 5;

    private Price $priceFrom;
    private Price $priceTo;
    private ?Price $requestedPrice;

    private FilterValueInterface $filterValue;

    public function __construct(
        array $priceRanges,
        ?float $requestedPrice = null // if client specified he want it to be 'around' some amount, use this value
    ) {
        if($requestedPrice) {
            $this->requestedPrice = new Price($requestedPrice);
        } else {
            $this->requestedPrice = null;
            $this->calculatePrices($priceRanges);
        }
    }

    public function __toString(): string
    {
        $result = ['from' => $this->priceFrom, 'to' => $this->priceTo];
        if($this->requestedPrice) {
            $result['from'] = $this->requestedPrice - ($this->requestedPrice * (self::PRICE_RANGE_TOLERANCE / 100));
            $result['to'] = $this->requestedPrice + ($this->requestedPrice * (self::PRICE_RANGE_TOLERANCE / 100));
        }
        return json_encode($result);
    }

    public function getServiceAlias(): string
    {
        return self::FILTER_ALIAS;
    }

    private function calculatePrices(array $priceRanges): void
    {
        if(!count($priceRanges) == 2) {
            throw new \InvalidArgumentException('Need exactly 2 prices to form a range');
        }

        if($priceRanges[0] > $priceRanges[1]) {
            throw new \InvalidArgumentException('Lower range value should be less than upper range value.');
        }

        $this->priceFrom =  new Price($priceRanges[0]);
        $this->priceTo = new Price($priceRanges[1]);

        $this->filterValue = (new ArrayFilterValue())
            ->__unserialize(['filter_value' => [
                'from' => $this->priceFrom->getFilterableValue()->__serialize(),
                'to'   => $this->priceTo->getFilterableValue()->__serialize()
            ]]);
    }

    public function getFilterableValue(): FilterValueInterface
    {
        return (new BoolFilterMustNotBeGreaterThan())->__unserialize(['filter_value' => $this->requestedPrice]);
    }
}
