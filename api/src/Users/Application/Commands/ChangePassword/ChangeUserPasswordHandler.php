<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\ChangePassword;

use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface; 
use App\Users\Application\Event\ChangePasswordEvent; 

class ChangeUserPasswordHandler
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $passwordHasher;
    private EventDispatcherInterface $eventDispatcher; 

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        EventDispatcherInterface $eventDispatcher 
    ) {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->eventDispatcher = $eventDispatcher; 
    }

    public function handle(ChangeUserPassword $command): void
    {
        $user = $this->userRepository->findById($command->dto->userId);

        if (!$user) {
            throw new NotFoundHttpException("User not found.");
        }


        if (!$this->passwordHasher->isPasswordValid($user, $command->dto->currentPassword)) {
            throw new BadRequestHttpException("The current password is incorrect.");
        }

        if ($command->dto->newPassword !== $command->dto->newPasswordConfirmation) {
            throw new BadRequestHttpException("The new passwords do not match.");
        }

        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $command->dto->newPassword)
        );

        $this->userRepository->save($user);


        $event = new ChangePasswordEvent($user->getId(), $command->dto->newPassword);
        $this->eventDispatcher->dispatch($event);
    }
}

