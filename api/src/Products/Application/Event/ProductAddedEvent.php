<?php

declare(strict_types=1);

namespace App\Products\Application\Event;

use App\Products\Domain\Entity\Product;
use DateTimeImmutable;

class ProductAddedEvent
{
    private Product $product;
    private DateTimeImmutable $dateTime;

    public function __construct(Product $product, DateTimeImmutable $dateTime)
    {
        $this->product = $product;
        $this->dateTime = $dateTime;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getProductName(): string
    {
        return $this->product->getName();
    }

    public function getDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }
}
