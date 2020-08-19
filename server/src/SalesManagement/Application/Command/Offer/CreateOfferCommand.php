<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command;

use ProxyManager\Generator\Util\UniqueIdentifierGenerator;
use RealDeal\Shared\Application\CommandInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Price;

class CreateOfferCommand implements CommandInterface
{
    /** @var string */
    private $name;

    /** @var float */
    private $totalPrice;

    /** @var float */
    private $footage;

    public function __construct(
        string $name,
        float $totalPrice,
        float $footage
    )
    {
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->footage = $footage;
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
}