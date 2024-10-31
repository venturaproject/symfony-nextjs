<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Create;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserHandler
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepositoryInterface $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function handle(CreateUser $command): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword(new User('', '', ''), $command->dto->password);
        $user = new User($command->dto->name, $command->dto->email, $hashedPassword);
        $this->userRepository->add($user);
    }
}
