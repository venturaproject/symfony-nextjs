<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Command;

interface CommandBusInterface
{
    public function handle(object $command): mixed;
    
    public function registerHandler(string $commandClass, callable $handler): void; 
}
