<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use InvalidArgumentException;

class Price
{
    public const PLN = 'PLN';

    public const AVAILABLE_CURRENCIES = ['PLN', 'EUR'];

    /** @var float */
    private $amount;

    /** @var string */
    private $currency;

    public function __construct(float $amount, string $currency=self::PLN)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }

    private function setAmount(float $amount): void
    {
        if($amount < 0) {
            throw new InvalidArgumentException('Price cannot be less than 0.');
        }
        $this->amount = $amount;
    }

    private function setCurrency(string $currency): void
    {
        if(!in_array($currency, self::AVAILABLE_CURRENCIES)) {
            throw new InvalidArgumentException('The currency' . $currency . ' is not recognized.');
        }
        $this->currency = $currency;
    }

    public function __toString(): string
    {
        return (string)$this->amount . ' ' . $this->currency;
    }
}
