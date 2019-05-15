<?php

namespace App\Service;


use App\Entity\Movie;
use App\Repository\MovieRepository;

class MovieService
{
    private $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get(int $id): ?Movie
    {
        return $this->repository->find($id);
    }
}