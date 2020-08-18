<?php
declare(strict_types=1);

namespace RealDeal\Shared\Application;

use RealDeal\Shared\Domain\AggregateRootInteface;

interface AggregateRootFactoryInterface
{
    public function create(): AggregateRootInteface;
}