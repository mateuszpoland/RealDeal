<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;
use RealDeal\Shared\Application\CommandInterface;

interface CommandBusInterface {
    public function handle(CommandInterface $command): void;
}