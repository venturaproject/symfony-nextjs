<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Delete;

use App\Users\Domain\Repository\UserRepositoryInterface;

class DeleteUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(DeleteUser $command): void
    {
        $user = $this->userRepository->findById($command->userId);
        if ($user) {
            $this->userRepository->delete($user);
        }
    }
}
