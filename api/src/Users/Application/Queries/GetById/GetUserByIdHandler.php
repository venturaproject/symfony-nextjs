<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetById;

use App\Users\Domain\Repository\UserRepositoryInterface;

class GetUserByIdHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserById $query): ?GetUserByIdDTO
    {
        $userEntity = $this->userRepository->findById($query->userId);

        if ($userEntity === null) {
            return null;
        }

        // Convertir la entidad a un DTO
        return new GetUserByIdDTO(
            $userEntity->getId(),
            $userEntity->getEmail(),
            $userEntity->getName(),
            $userEntity->getCreatedAt()->format('Y-m-d H:i:s'), 
            $userEntity->getUpdatedAt()->format('Y-m-d H:i:s')  
        );
    }
}
