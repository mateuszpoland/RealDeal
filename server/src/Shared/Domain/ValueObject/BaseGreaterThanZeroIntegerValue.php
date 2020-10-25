<?php
declare(strict_types=1);

namespace RealDeal\Shared\Domain\ValueObject;


abstract class BaseGreaterThanZeroIntegerValue
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function setValue(int $value): void
    {
        if($value <= 0) {
            throw new \Exception(sprintf('%s value should be greater than 0.', static::getValueNameModifier()));
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    abstract public function getValueNameModifier();
}
