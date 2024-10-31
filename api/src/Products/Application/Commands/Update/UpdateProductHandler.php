<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Update;

use App\Products\Domain\Repository\ProductRepositoryInterface;

class UpdateProductHandler
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(UpdateProduct $command): void
    {
        $dto = $command->dto; // Accedemos al DTO directamente
        $product = $this->repository->findById($command->id);

        if (!$product) {
            throw new \Exception('Product not found'); 
        }

        if ($dto->name !== null) {
            $product->setName($dto->name);
        }

        if ($dto->price !== null) {
            $product->setPrice($dto->price);
        }

        if ($dto->description !== null) {
            $product->setDescription($dto->description);
        }

        // Si date_add se proporciona, actualiza el campo
        if ($dto->date_add !== null) {
            $product->setDateAdd($dto->date_add);
        }

        $this->repository->update($product);
    }
}
