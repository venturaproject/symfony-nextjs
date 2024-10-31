<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Command;

use App\Shared\Application\Bus\Command\CommandBusInterface;

class CommandBus implements CommandBusInterface
{
    /** @var callable[] */
    private array $handlers = []; 

    public function registerHandler(string $commandClass, callable $handler): void
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function handle(object $command): mixed
    {
        $commandClass = get_class($command);

        if (!isset($this->handlers[$commandClass])) {
            throw new \Exception("No handler registered for command: $commandClass");
        }

        return ($this->handlers[$commandClass])($command);
    }
}


