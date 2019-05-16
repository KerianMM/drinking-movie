<?php

namespace App\Service;


use App\Entity\Participant;
use App\Entity\Rule;
use App\Repository\RuleRepository;
use App\Repository\SessionRepository;

class RuleService
{
    private $repository;

    public function __construct(RuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idSession
     * @param int $idMovie
     * @param int $idUser
     * @return Rule[]
     */
    public function getNotMatchedRules(int $idSession, int $idMovie, int $idUser): array
    {
        return $this->repository->findNotMatched($idSession, $idMovie, $idUser);
    }
}