<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Delete;

class DeleteUser
{
    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}
