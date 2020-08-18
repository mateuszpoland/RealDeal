<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

use RealDeal\Shared\Application\CommandInterface;
use RealDeal\Shared\Infrastructure\CommandBusInterface;

final class CommandBus implements CommandBusInterface
{
    private $handlers;

    public function map(string $command, callable $handler) 
    {
        $this->handlers[$command] = $handler;
    }

    public function handle(CommandInterface $command): void 
    {   
        $cmdIdentifier = get_class($command);
        if($handlerNotFound = !isset($this->handlers[$cmdIdentifier])){
            throw new \Exception('Handler not found');
        }
        call_user_func($this->handlers[$cmdIdentifier], $command);
    }
}