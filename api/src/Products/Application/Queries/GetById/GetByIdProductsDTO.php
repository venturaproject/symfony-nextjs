<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetById;

use App\Products\Domain\Entity\Product;

class GetByIdProductsDTO
{
    public ?Product $product;

    public function __construct(?Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        if (!$this->product) {
            return [];
        }

        return [
            'id' => $this->product->getId(),
            'name' => $this->product->getName(),
            'description' => $this->product->getDescription(),
            'price' => $this->product->getPrice(),
            'date_add' => $this->product->getDateAdd() ? $this->product->getDateAdd()->format('Y-m-d') : null,
            'created_at' => $this->product->getCreatedAdd() ? $this->product->getCreatedAdd()->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->product->getUpdatedAdd() ? $this->product->getUpdatedAdd()->format('Y-m-d H:i:s') : null,
        ];
    }
}


