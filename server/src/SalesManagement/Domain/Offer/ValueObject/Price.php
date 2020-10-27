<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Filter\ArrayFilterValue;
use RealDeal\SalesManagement\Domain\Filter\FilterValueInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

/**
 * @ORM\Embeddable()
 */
class Price implements FilterEnabledInterface
{
    public const PLN = 'PLN';
    public const AVAILABLE_CURRENCIES = ['PLN', 'EUR'];

    private const FILTER_ALIAS = 'price';

    /**
     * @ORM\Column(type="float")
     */
    private float $amount;

    /**
     * @ORM\Column(type="string")
     */
    private $currency;

    private FilterValueInterface $filterValue;

    public function __construct(float $amount, string $currency=self::PLN)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);

        $this->filterValue = (new ArrayFilterValue())
            ->__unserialize(['filter_value' => ['amount' => $this->amount, 'currency' => $this->currency]]);

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

    public function getServiceAlias(): string
    {
        return self::FILTER_ALIAS;
    }

    public function getFilterableValue(): FilterValueInterface
    {
        return $this->filterValue;
    }


}
