<?php

namespace App\Service;


use App\Entity\Participant;
use App\Repository\RuleRepository;
use App\Repository\SessionRepository;

class RuleService
{
    private $repository;

    public function __construct(RuleRepository $repository)
    {
        $this->repository = $repository;
    }
}