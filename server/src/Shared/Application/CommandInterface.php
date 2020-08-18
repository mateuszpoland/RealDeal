<?php
declare(strict_types=1);

namespace RealDeal\Shared\Application;

interface CommandInterface
{
    public function __toString(): string ;
}