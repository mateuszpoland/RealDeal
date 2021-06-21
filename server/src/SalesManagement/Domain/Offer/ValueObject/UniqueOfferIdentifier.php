<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

class UniqueOfferIdentifier
{
    private string $value;

    private function __construct()
    {
    }
    public static function create(): self
    {
        $obj = new self();
        $obj->value = uniqid("offer_", true);

        return $obj;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function unserialize(string $data)
    {
        $obj = new self();
        $obj->value = $data;

        return $obj;
    }
}
