<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter\ValueObject;


use RealDeal\SalesManagement\Domain\Offer\ValueObject\Price;

class PriceRange
{
    private Price $priceFrom;
    private Price $priceTo;
    private ?Price $requestedPrice;
    private float $priceRangePercent;

    public function __construct(
        float $priceFrom,
        float $priceTo,
        float $requestedPrice = null, // if client specified he want it to be 'around' some amount, use this value
        float $priceRangePercent = 5
    ) {
        if($requestedPrice) {
            $this->requestedPrice = new Price($requestedPrice);
            $this->priceRangePercent = $priceRangePercent;
        } else {
            $this->priceFrom = new Price($priceFrom);
            $this->priceTo = new Price($priceTo);
        }
    }

    public function __toString(): string
    {
        $result = ['from' => $this->priceFrom, 'to' => $this->priceTo];
        if($this->requestedPrice) {
            $result['from'] = $this->requestedPrice - ($this->requestedPrice * ($this->priceRangePercent / 100));
            $result['to'] = $this->requestedPrice + ($this->requestedPrice * ($this->priceRangePercent / 100));
        }
        return json_encode($result);
    }
}
