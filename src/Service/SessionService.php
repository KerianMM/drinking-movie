<?php

namespace App\Service;


use App\Entity\Participant;
use App\Repository\SessionRepository;

class SessionService
{
    private $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param Participant $participant
     * @return Participant[]
     */
    public function getByParticipantRegistered(Participant $participant): array
    {
        return $this->sessionRepository->findByParticipantRegistered($participant->getId());
    }

    /**
     * @param Participant $participant
     * @return Participant[]
     */
    public function getByParticipantNotRegistered(Participant $participant): array
    {
        return $this->sessionRepository->findByParticipantNotRegistered($participant->getId());
    }
}