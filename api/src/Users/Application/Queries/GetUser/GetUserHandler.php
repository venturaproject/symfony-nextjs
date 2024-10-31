<?php

declare(strict_types=1);


namespace App\Users\Application\Queries\GetUser;

use App\Users\Application\Queries\GetUser\GetUserQuery;
use App\Users\Application\Queries\GetUser\GetUserDTO;
use App\Users\Domain\Repository\UserRepositoryInterface;

class GetUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserQuery $query): GetUserDTO
    {
        $user = $this->userRepository->findById($query->getUserId());

        return new GetUserDTO(
            $user->getId(),
            $user->getEmail(),
            $user->getName(),
            $user->getCreatedAt(),
            $user->getUpdatedAt()
        );
    }
}




