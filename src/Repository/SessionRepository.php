<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Session::class);
    }

    /**
     * @param int $idParticipant
     * @return Session[] Returns an array of Session objects
     */
    public function findByParticipantRegistered(int $idParticipant)
    {
        return $this->createQueryBuilder('session')
            ->join('session.participants', 'participants')
            ->andWhere('participants.id = :id')
            ->setParameter('id', $idParticipant)
            ->orderBy('session.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $idParticipant
     * @return Session[] Returns an array of Session objects
     */
    public function findByParticipantNotRegistered(int $idParticipant)
    {
        $subquery = $this->createQueryBuilder('session2')
            ->select('session2.id')
            ->join('session2.participants', 'participants2')
            ->andWhere('participants2.id = :id')
            ->getQuery();

        $queryBuilder = $this->createQueryBuilder('session');

        return $queryBuilder
            ->andWhere(
                $queryBuilder->expr()->notIn(
                    'session.id',
                    $subquery->getDQL()
                )
            )
            ->setParameter('id', $idParticipant)
            ->orderBy('session.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
