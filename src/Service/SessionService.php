<?php

namespace App\Service;


use App\Entity\Participant;
use App\Repository\SessionRepository;

class SessionService
{
    private $repository;

    public function __construct(SessionRepository $repository)
    {
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
}