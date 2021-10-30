<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
     * @Route("/certifications", name="certification_")
     */
class CertificationController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(): Response
    {
        return $this->render('certification/browse.html.twig', [
            'controller_name' => 'CertificationController',
        ]);
    }
}
