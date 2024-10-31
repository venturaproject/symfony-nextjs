<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetById;

class GetProductById
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
