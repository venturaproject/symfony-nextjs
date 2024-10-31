<?php

declare(strict_types=1);

// src/Products/Application/EventListener/ProductAddedListener.php

namespace App\Products\Application\EventListener;

use App\Products\Application\Event\ProductAddedEvent;
use App\Shared\Application\Services\EmailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductAddedListener implements EventSubscriberInterface
{
    private EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public static function getSubscribedEvents()
    {
        return [
            ProductAddedEvent::class => 'onProductAdded',
        ];
    }

    public function onProductAdded(ProductAddedEvent $event): void
    {
        $data = [
            'productName' => $event->getProductName(),
            'dateTime' => $event->getDateTime()->format('d-m-Y H:i:s'),
        ];

        $this->emailService->send(
            'emails/new_product.html.twig',
            $data,
            'recipient@example.com', 
            'Nuevo Producto Añadido'
        );
    }
}

