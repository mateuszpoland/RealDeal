<?php
declare(strict_types=1);

namespace RealDeal\Shared\Application;

interface CommandHandlerInterface
{
    public function handle(): void;
}