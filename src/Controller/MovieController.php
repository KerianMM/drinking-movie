<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Session;
use App\Service\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private $service;

    public function __construct(MovieService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/session/{id}/movie/{idMovie}", name="movie_details", methods={"GET"})
     */
    public function show(Session $session, int $idMovie): Response
    {
        $movie = $this->service->get($idMovie);
        return $this->render('movie/details.html.twig', [
            'movie' => $movie,
            'session' => $session
        ]);
    }
}
