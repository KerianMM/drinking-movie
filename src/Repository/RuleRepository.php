<?php

namespace App\Repository;

use App\Entity\Match;
use App\Entity\Rule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rule[]    findAll()
 * @method Rule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rule::class);
    }

    /**
     * @param int $idSession
     * @param int $idMovie
     * @param int $idUser
     * @return Rule[]
     */
    public function findNotMatched(int $idSession, int $idMovie, int $idUser): array
    {
        $queryBuilder = $this->createQueryBuilder('rule');

        $subQueryBuilder = $this->getEntityManager()->getRepository(Match::class)->createQueryBuilder('match')
            ->select('rule2.id')
            ->join('match.rule', 'rule2')
            ->join('rule2.movie', 'movie2')
            ->join('match.session', 'session2')
            ->join('match.participant', 'participant2')
            ->andWhere('participant2.id = :participant')
            ->andWhere('movie2.id = :movie')
            ->andWhere('session2.id = :session')
        ;

        return $queryBuilder
            ->join('rule.movie', 'movie')
            ->andWhere('movie.id = :movie')
            ->andWhere(
                $queryBuilder->expr()->notIn('rule.id', $subQueryBuilder->getDQL())
            )
            ->setParameter(':movie', $idMovie)
            ->setParameter(':session', $idSession)
            ->setParameter(':participant', $idUser)
            ->getQuery()
            ->getResult();
    }
}
