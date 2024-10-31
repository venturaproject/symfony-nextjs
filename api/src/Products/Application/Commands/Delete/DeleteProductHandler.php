<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Delete;

use App\Products\Domain\Repository\ProductRepositoryInterface;

class DeleteProductHandler
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(DeleteProduct $command): void
    {
        $product = $this->repository->findById($command->getId());

        if ($product) {
            $this->repository->delete($product);
        }
    }
}

