<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller\Api;

use App\Users\Application\Commands\ChangePassword\ChangeUserPassword;
use App\Users\Application\Commands\ChangePassword\ChangeUserPasswordDTO;
use App\Users\Application\Queries\GetUser\GetUserQuery;
use App\Shared\Application\Bus\Command\CommandBusInterface;
use App\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    private TokenStorageInterface $tokenStorage;
    private QueryBusInterface $queryBus;
    private CommandBusInterface $commandBus;

    public function __construct(TokenStorageInterface $tokenStorage, QueryBusInterface $queryBus, CommandBusInterface $commandBus)
    {
        $this->tokenStorage = $tokenStorage;
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    #[Route('/profile', methods: ['GET'])]
    public function getAuthenticatedUser(): JsonResponse 
    {
        $token = $this->tokenStorage->getToken();
        $user = $token ? $token->getUser() : null;

        if (!$user instanceof \App\Users\Domain\Entity\User) {
            return new JsonResponse(['error' => 'User not authenticated.'], Response::HTTP_UNAUTHORIZED);
        }

        $query = new GetUserQuery($user->getId());
        $userData = $this->queryBus->handle($query);

        return new JsonResponse($userData->toArray());
    }

    #[Route('/user/change-password', methods: ['POST'])]
    public function changePassword(Request $request): JsonResponse
    {
        $token = $this->tokenStorage->getToken();
        $user = $token ? $token->getUser() : null;

        if (!$user instanceof \App\Users\Domain\Entity\User) {
            return new JsonResponse(['error' => 'User not authenticated.'], Response::HTTP_UNAUTHORIZED);
        }

        $data = json_decode($request->getContent(), true);
        $dto = new ChangeUserPasswordDTO(
            $user->getId(),
            $data['current_password'],
            $data['new_password'],
            $data['new_password_confirmation']
        );

        try {
            $this->commandBus->handle(new ChangeUserPassword($dto));
            return new JsonResponse(['message' => 'Password changed successfully.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
