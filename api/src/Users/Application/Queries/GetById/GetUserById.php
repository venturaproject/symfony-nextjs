<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetById;

class GetUserById
{
    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}
