<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

class PhpInfoService
{
    public function getInfo(): bool
    {
        return phpinfo();
    }
}
