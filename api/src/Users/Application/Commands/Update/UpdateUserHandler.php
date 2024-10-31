<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Update;

use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UpdateUserHandler
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepositoryInterface $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function handle(UpdateUser $command): void
    {
        $user = $this->userRepository->findById($command->userId);
        if ($user) {
            if ($command->dto->name !== null) {
                $user->setName($command->dto->name);
            }
            if ($command->dto->email !== null) {
                $user->setEmail($command->dto->email);
            }
            if ($command->dto->password !== null) {
                $hashedPassword = $this->passwordHasher->hashPassword($user, $command->dto->password);
                $user->setPassword($hashedPassword); 
            }

            $this->userRepository->update($user, ['updated_at' => new \DateTime()]); 
        }
    }
}
