<?php

namespace App\Shared\Infrastructure\Controller\Web;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Shared\Infrastructure\Service\PhpInfoService;

class PhpinfoController extends AbstractController
{
    #[Route('/phpinfo', name: 'app_phpinfo')]
    public function index(PhpInfoService $info): JsonResponse
    {
        $data = $info->getInfo();
        return new JsonResponse([
            'phpinfo' => $data,
        ]);
    }
}