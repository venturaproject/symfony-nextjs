<?php

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;
    public function delete(User $user): void;

    /**
     * @param array<string, mixed> $data
     */
    public function update(User $user, array $data): void; 

    /**
     * @return User[]
     */
    public function findAll(): array;

    public function findById(int $id): ?User;

    public function save(User $user): void;
}
