<?php

namespace App\Controller;

use App\Entity\Session;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/session", name="session_")
 */
class SessionController extends AbstractController
{
    private $service;

    public function __construct(SessionService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('session/register.html.twig', [
            'sessionsRegistered'    => $this->service->getByParticipantRegistered($user),
            'sessionsNotRegistered' => $this->service->getByParticipantNotRegistered($user),
        ]);
    }

    /**
     * @Route("/{id}", name="details", methods={"GET"})
     */
    public function show(Session $session): Response
    {
        return $this->render('session/details.html.twig', [
            'session' => $session,
        ]);
    }
}
