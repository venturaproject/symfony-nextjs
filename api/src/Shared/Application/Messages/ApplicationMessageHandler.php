<?php

declare(strict_types=1);

namespace App\Shared\Application\Messages;

use App\Shared\Application\Messages\ApplicationMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ApplicationMessageHandler 
{
    public function __invoke(ApplicationMessage $message): void
    {
        
        echo 'Procesando mensaje: ' . $message->getContent();
    }
}