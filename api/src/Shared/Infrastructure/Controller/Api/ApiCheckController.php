<?php

namespace App\Shared\Infrastructure\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/health-api', 'health-api', methods: ['GET'])]
class ApiCheckController
{
    public function __invoke(): JsonResponse 
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
