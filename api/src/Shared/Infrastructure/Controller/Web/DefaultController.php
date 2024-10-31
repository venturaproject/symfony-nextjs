<?php

namespace App\Shared\Infrastructure\Controller\Web;



use App\Shared\Infrastructure\Service\GreetingGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{
    #[Route('/hello/{name}', 'hello-check', methods: ['GET'])]
    public function index($name, LoggerInterface $logger, GreetingGenerator $generator)
    {
        $greeting = $generator->getRandomGreeting();

        return new JsonResponse(['status' => "Saying $greeting to $name!"]);


    }
}
