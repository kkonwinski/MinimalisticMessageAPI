<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
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

        if (!is_string($messageText)) {
            throw new HttpException(JsonResponse::HTTP_BAD_REQUEST, "Invalid message");
        }

        $result = $this->messageService->createAndStoreMessage($messageText);

        if (isset($result['error'])) {
            return new JsonResponse($result['error'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return new JsonResponse(['message' => $result['uuid']], JsonResponse::HTTP_CREATED);
    }

    #[Route('/message/list', name: 'message_list', methods: ['GET'])]
    public function listMessage(Request $request): JsonResponse
    {
        $orderByUuid = $request->query->get('orderByUuid');
        $orderByDate = $request->query->get('orderByDate');


        $messages = $this->messageService->getAndSortMessagesByUuidAndCreationTime($orderByUuid, $orderByDate);
        return new JsonResponse($messages, JsonResponse::HTTP_OK);
    }

    #[Route('/message/list/{uuid}', name: 'message_list_uuid', methods: ['GET'])]
    public function getMessageByUuid(string $uuid): JsonResponse
    {
        $message = $this->messageService->getMessageByUuid($uuid);

        return new JsonResponse($message, JsonResponse::HTTP_OK);
    }

}
