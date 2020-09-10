<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command;

use ProxyManager\Generator\Util\UniqueIdentifierGenerator;
use RealDeal\Shared\Application\CommandInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Price;

class CreateOfferCommand implements CommandInterface
{
    /** @var string */
    private string $name;

    /** @var float */
    private float $totalPrice;

    /** @var float */
    private float $footage;

    /** @var int */
    private int $clientId;

    public function __construct(
        string $name,
        float $totalPrice,
        float $footage,
        int $clientId
    )
    {
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->footage = $footage;
        $this->clientId = $clientId;
    }

    public function __toString(): string
    {
        return get_class($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getFootage(): float
    {
        return $this->footage;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }
}