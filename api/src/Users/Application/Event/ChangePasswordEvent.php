<?php

declare(strict_types=1);

namespace App\Users\Application\Event;

class ChangePasswordEvent
{
    private int $userId; 
    private string $newPassword;

    public function __construct(int $userId, string $newPassword) 
    {
        $this->userId = $userId;
        $this->newPassword = $newPassword;
    }

    public function getUserId(): int 
    {
        return $this->userId;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}
