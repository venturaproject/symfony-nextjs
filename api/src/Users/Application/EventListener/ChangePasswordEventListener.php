<?php

declare(strict_types=1);

namespace App\Users\Application\EventListener;

use App\Users\Application\Event\ChangePasswordEvent; 
use App\Shared\Application\Services\EmailService;
use App\Users\Domain\Repository\UserRepositoryInterface; 
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 

class ChangePasswordEventListener implements EventSubscriberInterface
{
    private EmailService $emailService;
    private UserRepositoryInterface $userRepository; 

    public function __construct(EmailService $emailService, UserRepositoryInterface $userRepository)
    {
        $this->emailService = $emailService;
        $this->userRepository = $userRepository; 
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ChangePasswordEvent::class => 'onChangePassword',
        ];
    }

    public function onChangePassword(ChangePasswordEvent $event): void
    {
        $userId = (int) $event->getUserId(); 
        $newPassword = $event->getNewPassword(); 


        $user = $this->userRepository->findById($userId);

        if ($user) {
            $recipientEmail = $user->getEmail(); 
            $userName = $user->getName();


            $this->emailService->send(
                'emails/change_password.html.twig', 
                [
                    'userId' => $userId, 
                    'userName' => $userName, 
                    'newPassword' => $newPassword,
                    'dateTime' => new \DateTime(),  
                ], 
                $recipientEmail, 
                'Your Password Has Been Changed'
            );
        } else {

            throw new NotFoundHttpException("User with ID $userId not found.");
        }
    }
}
