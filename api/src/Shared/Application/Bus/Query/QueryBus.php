<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Query;

use App\Shared\Application\Bus\Query\QueryBusInterface;

class QueryBus implements QueryBusInterface
{
    /** @var callable[] */
    private array $handlers = []; 

    public function registerHandler(string $queryClass, callable $handler): void
    {
        $this->handlers[$queryClass] = $handler;
    }

    public function handle(object $query): mixed
    {
        $queryClass = get_class($query);

        if (!isset($this->handlers[$queryClass])) {
            throw new \Exception("No handler registered for query: $queryClass");
        }

        return ($this->handlers[$queryClass])($query);
    }
}

