<?php

namespace App\Shared\Infrastructure\Controller\Web;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotFoundRedirectController extends AbstractController
{
    private Environment $twig; // Propiedad para el servicio Twig

    public function __construct(Environment $twig)
    {
        $this->twig = $twig; // Inicializa el servicio Twig
    }

    #[Route('/not-found', name: 'not_found')]
    public function __invoke(): Response
    {
        // Renderiza la plantilla 404.html.twig
        $content = $this->twig->render('errors/404.html.twig');
        return new Response($content, 404);
    }
}
