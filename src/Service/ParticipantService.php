<?php

namespace App\Service;


use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use App\Repository\SessionRepository;

class ParticipantService
{
    private $repository;

    public function __construct(ParticipantRepository $repository)
    {
        $this->repository = $repository;
    }
}