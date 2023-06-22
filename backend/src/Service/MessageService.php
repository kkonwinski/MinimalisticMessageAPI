<?php
namespace App\Service;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class MessageService
{
    private MessageRepository $messageRepository;
    private ValidatorInterface $validator;
    private MessageFile $messageFile;
    private EntityManagerInterface $entityManager;

    public function __construct(MessageRepository $messageRepository, ValidatorInterface $validator, MessageFile $messageFile, EntityManagerInterface $entityManager)
    {
        $this->messageRepository = $messageRepository;
        $this->validator = $validator;
        $this->messageFile = $messageFile;
        $this->entityManager = $entityManager;
    }

    public function createAndStoreMessage(string $messageText): array
    {
        $message = new Message($messageText);
        $errors = $this->validator->validate($message);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $violation) {
                $errorMessages[$violation->getPropertyPath()][] = $violation->getMessage();
            }
            return ['error' => $errorMessages];
        }

        $this->messageRepository->save($message, true);

        $this->messageFile->store($messageText);
        return ['uuid' => (string)$message->getUuid()];
    }

    public function getAllMessages(): array
    {
        $messages = $this->messageRepository->findAll();
        return array_map(function (Message $message) {
            return $this->formatMessage($message);
        }, $messages);
    }

    public function getMessageByUuid(string $uuid): ?array
    {
        $uuidObj = Uuid::fromString($uuid);
        $message = $this->messageRepository->findOneBy(['uuid' => $uuidObj]);
        return $message ? $this->formatMessage($message) : null;
    }

    public function getAndSortMessagesByUuidAndCreationTime(?Uuid $uuid, ?\DateTimeImmutable $createdAt, ?string $orderByUuid, ?string $orderByDate): array
    {
        $messages = $this->messageRepository->findByUuidAndCreationTime($uuid, $createdAt, $orderByUuid, $orderByDate);

        return array_map(function (Message $message) {
            return $this->formatMessage($message);
        }, $messages);
    }


    private function formatMessage(Message $message): array
    {
        return [
            'id' => $message->getId(),
            'message' => $message->getMessage(),
            'createdAt' => $message->getCreatedAt()->format('Y-m-d H:i:s'),
            'uuid' => (string)$message->getUuid(),
        ];
    }
}
