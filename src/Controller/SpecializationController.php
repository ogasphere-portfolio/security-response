<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
     * @Route("/specialisations", name="specializtion_")
     */
class SpecializationController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(): Response
    {
        return $this->render('specialzation/browse.html.twig', [
            'controller_name' => 'SpecialzationController',
        ]);
    }
}
