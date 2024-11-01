<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Update;

use App\Products\Domain\Repository\ProductRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Products\Application\Messages\ProductUpdatedMessage;

class UpdateProductHandler
{
    private ProductRepositoryInterface $repository;
    private MessageBusInterface $messageBus;

    public function __construct(ProductRepositoryInterface $repository, MessageBusInterface $messageBus)
    {
        $this->repository = $repository;
        $this->messageBus = $messageBus;
    }

    public function handle(UpdateProduct $command): void
    {
        $dto = $command->dto; // Accedemos al DTO directamente
        $product = $this->repository->findById($command->id);

        if (!$product) {
            throw new \Exception('Product not found'); 
        }

        if ($dto->name !== null) {
            $product->setName($dto->name);
        }

        if ($dto->price !== null) {
            $product->setPrice($dto->price);
        }

        if ($dto->description !== null) {
            $product->setDescription($dto->description);
        }

        // Si date_add se proporciona, actualiza el campo
        if ($dto->date_add !== null) {
            $product->setDateAdd($dto->date_add);
        }

        $this->repository->update($product);

        // Enviar mensaje con información del producto actualizado
        $message = new ProductUpdatedMessage(
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getDescription()
        );

        $this->messageBus->dispatch($message);
    }
}
