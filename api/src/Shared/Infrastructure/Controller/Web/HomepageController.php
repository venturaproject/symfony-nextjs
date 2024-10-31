<?php

namespace App\Shared\Infrastructure\Controller\Web;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
      
        $healthData = [
            'status' => 'ok',
            'timestamp' => date('Y-m-d H:i:s'),
     
        ];

        $this->logger->info('Accediendo a la página de inicio', $healthData);

        return $this->render('homepage/index.html.twig', [
            'health' => $healthData,
        ]);
    }
}

