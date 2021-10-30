<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialzationController extends AbstractController
{
    /**
     * @Route("/specialzation", name="specialzation")
     */
    public function index(): Response
    {
        return $this->render('specialzation/index.html.twig', [
            'controller_name' => 'SpecialzationController',
        ]);
    }
}
