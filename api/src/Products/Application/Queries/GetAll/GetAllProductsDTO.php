<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetAll;

use App\Products\Domain\Entity\Product;

class GetAllProductsDTO
{
    /** @var Product[] */
    public array $products;

    /**
     * @param Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function toArray(): array
    {
        return array_map(fn(Product $product) => [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'date_add' => $product->getDateAdd() ? $product->getDateAdd()->format('Y-m-d') : null,
            'created_at' => $product->getCreatedAdd() ? $product->getCreatedAdd()->format('Y-m-d H:i:s') : null,
            'updated_at' => $product->getUpdatedAdd() ? $product->getUpdatedAdd()->format('Y-m-d H:i:s') : null,
        ], $this->products);
    }
}
