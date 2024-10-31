<?php

declare(strict_types=1);

namespace App\Products\Domain\Repository;

use App\Products\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function add(Product $product): void;

    public function findById(int $id): ?Product;

    /**
     * @return Product[]
     */
    public function findAll(): array; // Método para obtener todos los productos

    public function delete(Product $product): void;

    public function update(Product $product): void;
}
