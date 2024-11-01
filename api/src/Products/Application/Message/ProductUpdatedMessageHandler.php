<?php

declare(strict_types=1);

namespace App\Products\Application\Messages;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Psr\Log\LoggerInterface;

#[AsMessageHandler]
class ProductUpdatedMessageHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ProductUpdatedMessage $message): void
    {
        // Crear un log con la información del producto
        $this->logger->info('Producto actualizado', [
            'productId' => $message->getProductId(),
            'name' => $message->getName(),
            'price' => $message->getPrice(),
            'description' => $message->getDescription(),
        ]);
    }
}
