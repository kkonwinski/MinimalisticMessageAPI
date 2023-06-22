<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class MessageController extends AbstractController
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    #[Route('/messages', name: 'messages', methods: ['GET'])]
    public function getMessages(): JsonResponse
    {
        return new JsonResponse($this->messageService->getAllMessages(), JsonResponse::HTTP_OK);
    }

    #[Route('/message/add', name: 'message_add', methods: ['POST'])]
    public function addMessage(Request $request): JsonResponse
    {
        $messageText = $request->request->get('message');
        $result = $this->messageService->createMessage($messageText);

        if (isset($result['error'])) {
            return new JsonResponse($result['error'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['message' => $result['uuid']], JsonResponse::HTTP_OK);
    }

    #[Route('/message/list/{uuid}/{createdAt}', name: 'message_list', methods: ['GET'])]
    public function listMessage(string $uuid, string $createdAt): JsonResponse
    {
        $messages = $this->messageService->getMessagesByUuidAndCreationTime($uuid, $createdAt);

        return new JsonResponse($messages, JsonResponse::HTTP_OK);
    }

    #[Route('/message/list/{uuid}', name: 'message_list_uuid', methods: ['GET'])]
    public function getMessageByUuid(string $uuid): JsonResponse
    {
        $message = $this->messageService->getMessageByUuid($uuid);

        if (!$message) {
            return new JsonResponse('Message not found', JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($message, JsonResponse::HTTP_OK);
    }

}
