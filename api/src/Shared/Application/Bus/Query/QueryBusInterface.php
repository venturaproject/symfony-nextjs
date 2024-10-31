<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Query;

interface QueryBusInterface
{
    public function handle(object $query): mixed;

    public function registerHandler(string $queryClass, callable $handler): void; 
}
