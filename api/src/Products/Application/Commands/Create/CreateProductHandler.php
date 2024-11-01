<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Create;

use App\Products\Domain\Entity\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use App\Products\Application\Event\ProductAddedEvent;

class CreateProductHandler
{
    private ProductRepositoryInterface $repository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(ProductRepositoryInterface $repository, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateProduct $command): void
    {
        $dto = $command->getDTO();

        $product = new Product(
            name: $dto->name,
            price: $dto->price,
            description: $dto->description
        );

        if ($dto->date_add) {
            $product->setDateAdd($dto->date_add);
        }

        $this->repository->add($product);

        $event = new ProductAddedEvent($product, new \DateTimeImmutable());
        $this->eventDispatcher->dispatch($event);
    }
}

