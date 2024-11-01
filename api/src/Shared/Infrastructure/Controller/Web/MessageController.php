<?php

namespace App\Shared\Infrastructure\Controller\Web;


use App\Shared\Application\Messages\ApplicationMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/send-message', name: 'send_message')]
    public function sendMessage(Request $request): JsonResponse
    {
        $content = $request->request->get('content', 'Mensaje de prueba'); // Obtenemos el contenido desde el request
        $message = new ApplicationMessage($content);
        
        $this->messageBus->dispatch($message); // Despachamos el mensaje

        return new JsonResponse(['status' => 'Mensaje enviado correctamente']);
    }
}