<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\ChangePassword;

class ChangeUserPassword
{
    public ChangeUserPasswordDTO $dto;

    public function __construct(ChangeUserPasswordDTO $dto)
    {
        $this->dto = $dto;
    }
}
