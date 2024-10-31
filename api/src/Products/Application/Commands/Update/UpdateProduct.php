<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Update;

use App\Products\Application\Commands\Update\UpdateProductDTO;

class UpdateProduct
{
    public int $id;
    public UpdateProductDTO $dto;

    public function __construct(int $id, UpdateProductDTO $dto)
    {
        $this->id = $id;
        $this->dto = $dto;
    }
}
