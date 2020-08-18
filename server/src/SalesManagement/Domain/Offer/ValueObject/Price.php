<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use InvalidArgumentException;

class Price
{
    public const PLN = 'PLN';

    public function __construct(float $amount, string $currency=self::PLN)
    {
        $this->setAmount($amount);
    }

    public function setAmount(float $amount): void
    {
        if($amount < 0) {
            throw InvalidArgumentException('');
        }
    }
}