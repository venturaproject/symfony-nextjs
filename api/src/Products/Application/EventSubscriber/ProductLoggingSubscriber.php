<?php

declare(strict_types=1);

namespace App\Products\Application\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use App\Products\Domain\Entity\Product;

class ProductLoggingSubscriber implements EventSubscriber
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::preRemove,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof Product) {
            $this->logger->info('prePersist event triggered for Product', [
                'entity' => get_class($entity),
                'data' => [
                    'id' => $entity->getId(),
                    'name' => $entity->getName(),
                    'price' => $entity->getPrice(),
                    'description' => $entity->getDescription(),
                    'created_at' => $entity->getCreatedAdd()->format('Y-m-d H:i:s'),
                ],
            ]);
        }
    }
    
    public function preUpdate(LifecycleEventArgs $args): void
    {
       
        $this->logger->info('Entering preUpdate method'); 
        $entity = $args->getObject();
        if ($entity instanceof Product) {
            $this->logger->info('preUpdate event triggered for Product', [
                'entity' => get_class($entity),
                'data' => [
                    'id' => $entity->getId(),
                    'name' => $entity->getName(),
                    'price' => $entity->getPrice(),
                    'description' => $entity->getDescription(),
                    'updated_at' => $entity->getUpdatedAdd()->format('Y-m-d H:i:s'),
                ],
            ]);
        }
    }
    
    public function preRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof Product) {
            $this->logger->info('preRemove event triggered for Product', [
                'entity' => get_class($entity),
                'data' => [
                    'id' => $entity->getId(),
                    'name' => $entity->getName(),
                ],
            ]);
        }
    }
}

