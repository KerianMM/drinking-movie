<?php

namespace App\Service;


use App\Entity\Participant;
use App\Entity\Session;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;

class SessionService extends AbstractService
{
    private $repository;

    public function __construct(SessionRepository $repository, EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $repository;
    }

    /**
     * @param Participant $participant
     * @return Participant[]
     */
    public function getByParticipantRegistered(Participant $participant): array
    {
        return $this->repository->findByParticipantRegistered($participant->getId());
    }

    /**
     * @param Participant $participant
     * @return Participant[]
     */
    public function getByParticipantNotRegistered(Participant $participant): array
    {
        return $this->repository->findByParticipantNotRegistered($participant->getId());
    }

    public function finish(Session $session): void
    {
        $session->setIsFinished(true);
        $this->entityManager->persist($session);
        $this->entityManager->flush();
    }
}