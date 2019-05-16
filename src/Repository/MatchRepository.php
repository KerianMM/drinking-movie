<?php

namespace App\Repository;

use App\Entity\Match;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Match|null find($id, $lockMode = null, $lockVersion = null)
 * @method Match|null findOneBy(array $criteria, array $orderBy = null)
 * @method Match[]    findAll()
 * @method Match[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Match::class);
    }

    public function findBySessionAndMovieAndUser(int $idSession, int $idMovie, int $idParticipant): array
    {
        $queryBuilder = $this->createQueryBuilder('match');

        return $queryBuilder
            ->join('match.rule', 'rule')
            ->join('rule.movie', 'movie')
            ->join('match.session', 'session')
            ->join('match.participant', 'participant')
            ->andWhere('participant.id = :participant')
            ->andWhere('movie.id = :movie')
            ->andWhere('session.id = :session')
            ->setParameter(':movie', $idMovie)
            ->setParameter(':session', $idSession)
            ->setParameter(':participant', $idParticipant)
            ->getQuery()
            ->getResult()
            ;
    }
}
