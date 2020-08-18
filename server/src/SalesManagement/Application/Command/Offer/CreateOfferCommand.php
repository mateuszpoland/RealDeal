<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command;

use RealDeal\Shared\Application\CommandInterface;
use Pr

class CreateOfferCommand implements CommandInterface
{
    private $name;

    private $totalPrice;

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

    public function getTotalPrice(): Price
    {
        return $this->totalPrice;
    }

    public function getFootage(): float
}