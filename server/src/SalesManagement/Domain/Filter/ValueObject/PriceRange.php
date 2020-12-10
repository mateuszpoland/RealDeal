<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter\ValueObject;


use RealDeal\SalesManagement\Domain\Filter\ArrayFilterValue;
use RealDeal\SalesManagement\Domain\Filter\BoolFilterValuesBetween;
use RealDeal\SalesManagement\Domain\Filter\ElasticFilterInterface;
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
        return get_class($this);
    }

    public function getElasticFieldName(): string
    {
        return 'total_price.value';
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
    }

    public function serialize()
    {
        return serialize([
            'price_ranges' => [$this->priceFrom, $this->priceTo],
            'requested_price' =>$this->requestedPrice
        ]);
    }

    public function unserialize($serialized)
    {
        $unserialized = unserialize($serialized);

        $this->priceFrom = $unserialized['price_ranges'][0];
        $this->priceTo = $unserialized['price_ranges'][1];
        $this->requestedPrice = $unserialized['requested_price'];
    }


    public function getFilterableValue(): ?ElasticFilterInterface
    {
        //@TODO - check if requested price is specified, if so, use another filter, like BoolFilterLessThan..
        return (new BoolFilterValuesBetween())
            ->__unserialize([
                'fieldName' => $this->getElasticFieldName(),
                'value' => [
                    'from' => $this->priceFrom->getAmount(),
                    'to'   => $this->priceTo->getAmount()
                ]]);
    }
}
