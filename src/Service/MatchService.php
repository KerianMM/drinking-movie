<?php

namespace App\Service;


use App\Entity\Match;
use App\Entity\Participant;
use App\Entity\Rule;
use App\Entity\Session;
use App\Repository\MatchRepository;
use Doctrine\ORM\EntityManagerInterface;

class MatchService extends AbstractService
{
    private $repository;

    public function __construct(MatchRepository $repository, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $repository;
    }

    /**
     * @param Rule[] $rules
     * @param Session $session
     * @param Participant $participant
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createMatchForRules(array $rules, Session $session, Participant $participant): void
    {
        foreach ($rules as $rule){
            $match = (new Match())
                ->setParticipant($participant)
                ->setRule($rule)
                ->setSession($session)
                ->setCount(0)
            ;

            $this->entityManager->persist($match);
        }
        $this->entityManager->flush();
    }

    /**
     * @param int $idSession
     * @param int $idMovie
     * @param int $idParticipant
     * @return Match[]
     */
    public function getBySessionAndMovieAndUser(int $idSession, int $idMovie, int $idParticipant): array
    {
        return $this->repository->findBySessionAndMovieAndUser($idSession, $idMovie, $idParticipant);
    }
}