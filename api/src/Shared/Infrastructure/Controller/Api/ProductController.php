<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller\Api;

use App\Products\Application\Commands\Create\CreateProduct;
use App\Products\Application\Commands\Create\CreateProductDTO;
use App\Products\Application\Commands\Update\UpdateProduct;
use App\Products\Application\Commands\Update\UpdateProductDTO;
use App\Products\Application\Commands\Delete\DeleteProduct;
use App\Products\Application\Queries\GetAll\GetAllProducts;
use App\Products\Application\Queries\GetAll\GetAllProductsDTO;
use App\Products\Application\Queries\GetById\GetProductById;
use App\Products\Application\Queries\GetById\GetByIdProductsDTO;
use App\Shared\Application\Bus\Query\QueryBusInterface;
use App\Shared\Application\Bus\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private QueryBusInterface $queryBus; 
    private CommandBusInterface $commandBus; 

    public function __construct(QueryBusInterface $queryBus, CommandBusInterface $commandBus)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus; 
    }

    #[Route('/products', methods: ['GET'])]
    public function getAllProducts(): JsonResponse
    {
        $query = new GetAllProducts();

        /** @var GetAllProductsDTO $productsDTO */
        $productsDTO = $this->queryBus->handle($query);

        return $this->json($productsDTO->toArray());
    }

    #[Route('/products/{id}', methods: ['GET'])]
    public function getProductById(int $id): JsonResponse
    {
        $query = new GetProductById($id);
        /** @var GetByIdProductsDTO $productDTO */
        $productDTO = $this->queryBus->handle($query);

        return new JsonResponse($productDTO->toArray());
    }

    #[Route('/products', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

 
        if (!isset($data['name'], $data['price'])) {
            return $this->json(['error' => 'Name and price are required'], Response::HTTP_BAD_REQUEST);
        }

        // Crear el DTO
        $dto = new CreateProductDTO(
            name: $data['name'],
            price: (float) $data['price'],
            description: $data['description'] ?? null,
            date_add: isset($data['date_add']) ? new \DateTime($data['date_add']) : null
        );

        $command = new CreateProduct($dto);

        $this->commandBus->handle($command);

        return $this->json(['status' => 'Product created'], Response::HTTP_CREATED);
    }

    #[Route('/products/{id}', methods: ['PUT', 'PATCH'])]
    public function updateProduct(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        if (empty($data)) {
            return $this->json(['error' => 'No data provided for update'], Response::HTTP_BAD_REQUEST);
        }

   
        $dto = new UpdateProductDTO(
            name: $data['name'] ?? null,
            price: isset($data['price']) ? (float)$data['price'] : null,
            description: $data['description'] ?? null,
            date_add: isset($data['date_add']) ? new \DateTime($data['date_add']) : null
        );

        $command = new UpdateProduct($id, $dto);
        $this->commandBus->handle($command);

        return $this->json(['status' => 'Product updated'], Response::HTTP_OK);
    }

    #[Route('/products/{id}', methods: ['DELETE'])]
    public function deleteProduct(int $id): JsonResponse
    {
        $command = new DeleteProduct($id);
        $this->commandBus->handle($command);

        return $this->json(['status' => 'Product deleted'], Response::HTTP_OK);
    }
}
