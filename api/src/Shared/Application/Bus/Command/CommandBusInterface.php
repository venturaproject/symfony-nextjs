<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Command;

interface CommandBusInterface
{
    public function handle(object $command): mixed;
}
