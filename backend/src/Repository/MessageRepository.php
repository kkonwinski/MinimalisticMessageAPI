<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @extends ServiceEntityRepository<Message>
 *
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function save(Message $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Message $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUuidAndCreationTime($orderByUuid, $orderByDate): array
    {
        $queryBuilder = $this->createQueryBuilder('m');

        if ($orderByUuid || $orderByDate) {
            if ($orderByUuid === 'asc') {
                $queryBuilder->addOrderBy('m.uuid', 'ASC');
            } elseif ($orderByUuid === 'desc') {
                $queryBuilder->addOrderBy('m.uuid', 'DESC');
            }

            if ($orderByDate === 'asc') {
                $queryBuilder->addOrderBy('m.createdAt', 'ASC');
            } elseif ($orderByDate === 'desc') {
                $queryBuilder->addOrderBy('m.createdAt', 'DESC');
            }
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
