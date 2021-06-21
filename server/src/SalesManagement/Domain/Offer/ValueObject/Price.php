<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Filter\BoolFilterMustNotBeGreaterThan;
use RealDeal\SalesManagement\Domain\Filter\ElasticFilterInterface;
use RealDeal\SalesManagement\Domain\Filter\FilterValueInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

/**
 * @ORM\Embeddable()
 */
class Price implements FilterEnabledInterface
{
    public const PLN = 'PLN';
    public const AVAILABLE_CURRENCIES = ['PLN', 'EUR'];

    /**
     * @ORM\Column(type="float")
     */
    private float $amount;

    /**
     * @ORM\Column(type="string")
     */
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

    public function getServiceAlias(): string
    {
        return get_class($this);
    }

    public function getElasticFieldName(): string
    {
        return 'total_price.value';
    }

    public function getFilterableValue(): ElasticFilterInterface
    {
        return (new BoolFilterMustNotBeGreaterThan())->__unserialize([
            'value' => $this->amount,
            'fieldName' => $this->getElasticFieldName()
        ]);
    }

    public function serialize(): string
    {
        return json_encode([
            'amount' => $this->amount,
            'currency' =>$this->currency
        ], JSON_THROW_ON_ERROR);
    }

    public function unserialize(string $serialized): self
    {
        $decoded = json_decode($serialized, true);
        $obj = new self($decoded['amount'], $decoded['currency']);

        return $obj;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
