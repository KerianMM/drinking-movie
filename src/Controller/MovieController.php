<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Session;
use App\Repository\MatchRepository;
use App\Service\MatchService;
use App\Service\MovieService;
use App\Service\RuleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private $service;
    private $matchService;
    private $ruleService;

    public function __construct(MovieService $service, MatchService $matchService, RuleService $ruleService)
    {
        $this->service = $service;
        $this->ruleService = $ruleService;
        $this->matchService = $matchService;
    }

    /**
     * @Route("/session/{id}/movie/{idMovie}", name="movie_details", methods={"GET"})
     */
    public function show(Session $session, int $idMovie): Response
    {
        if($session->getIsFinished()){
            return $this->redirectToRoute('session_finish');
        }

        $rules = $this->ruleService->getNotMatchedRules(
            $session->getId(),
            $idMovie,
            $this->getUser()->getId()
        );

        $this->matchService->createMatchForRules($rules, $session, $this->getUser());

        $matchs = $this->matchService->getBySessionAndMovieAndUser($session->getId(), $idMovie, $this->getUser()->getId());

        return $this->render('movie/details.html.twig', [
            'movie' => $matchs[0]->getRule()->getMovie(),
            'session' => $session,
            'matchs' => $matchs
        ]);
    }
}
