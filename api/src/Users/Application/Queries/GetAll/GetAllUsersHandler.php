<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetAll;

use App\Users\Domain\Repository\UserRepositoryInterface;

class GetAllUsersHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return GetAllUsersDTO[]  
     */
    public function handle(GetAllUsers $query): array
    {
        $users = $this->userRepository->findAll();
        $userDTOs = [];

        foreach ($users as $userEntity) {
            $userDTOs[] = new GetAllUsersDTO(
                $userEntity->getId(),
                $userEntity->getEmail(),
                $userEntity->getName(),
                $userEntity->getCreatedAt()->format('Y-m-d H:i:s'),
                $userEntity->getUpdatedAt()->format('Y-m-d H:i:s')
            );
        }

        return $userDTOs;
    }
}
