<?php

namespace App\Shared\Infrastructure\Controller\Web;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotFoundRedirectController extends AbstractController
{

    #[Route('/not-found', name: 'not_found')]
    public function index(): Response
    {
        return $this->render('errors/404.html.twig');
   
    }
}

