<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\ChangePassword;

class ChangeUserPasswordDTO
{
    public int $userId;
    public string $currentPassword;
    public string $newPassword;
    public string $newPasswordConfirmation;

    public function __construct(
        int $userId,
        string $currentPassword,
        string $newPassword,
        string $newPasswordConfirmation
    ) {
        $this->userId = $userId;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->newPasswordConfirmation = $newPasswordConfirmation;
    }
}
