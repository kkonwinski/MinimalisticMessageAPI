<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class MessageController extends AbstractController
{
    #[Route('/messages', name: 'messages', methods: ['GET'])]
    public function getMessages(MessageRepository $messageRepository): JsonResponse
    {
        return new JsonResponse($messageRepository->findAll(), JsonResponse::HTTP_OK, []);
    }

    #[Route('/message/add', name: 'message_add', methods: ['POST'])]
    public function addMessage(Request $request, MessageRepository $messageRepository): JsonResponse
    {
        $messageText = $request->request->get('message');
        $message = new Message($messageText);
        $messageRepository->save($message, true);
        return new JsonResponse(['message' => $messageText], JsonResponse::HTTP_OK, []);
    }

}
