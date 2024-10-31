<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Create;

class CreateProduct
{
    private CreateProductDTO $dto;

    public function __construct(CreateProductDTO $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): CreateProductDTO
    {
        return $this->dto;
    }
}