<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetById;

use App\Products\Domain\Repository\ProductRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetProductByIdHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductById $query): GetByIdProductsDTO
    {
        // Busca el producto por su ID
        $product = $this->productRepository->findById($query->id);

        // Si no se encuentra, lanza una excepción
        if (!$product) {
            throw new NotFoundHttpException(sprintf("The product with ID %d was not found.", $query->id));
        }

        // Retorna el DTO en lugar de la entidad
        return new GetByIdProductsDTO($product);
    }
}

