<?php

namespace App\Controller;

use App\Entity\Rule;
use App\Form\RuleType;
use App\Repository\RuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rule")
 */
class RuleController extends AbstractController
{
    /**
     * @Route("/", name="rule_index", methods={"GET"})
     */
    public function index(RuleRepository $ruleRepository): Response
    {
        return $this->render('rule/index.html.twig', [
            'rules' => $ruleRepository->findAll(),
        ]);
    }
}
