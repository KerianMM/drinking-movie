<?php

namespace App\Service;


use App\Entity\Participant;
use App\Repository\MovieRepository;
use App\Repository\SessionRepository;

class MovieService
{
    private $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }
}