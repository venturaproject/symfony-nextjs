<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Update;

class UpdateUser
{
    public int $userId;
    public UpdateUserDTO $dto;

    public function __construct(int $userId, UpdateUserDTO $dto)
    {
        $this->userId = $userId;
        $this->dto = $dto;
    }
}
