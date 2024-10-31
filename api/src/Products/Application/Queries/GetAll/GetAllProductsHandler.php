<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetAll;

use App\Products\Domain\Repository\ProductRepositoryInterface;

class GetAllProductsHandler
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(GetAllProducts $query): GetAllProductsDTO
    {
        $products = $this->repository->findAll(); 
        return new GetAllProductsDTO($products); 
    }
}
