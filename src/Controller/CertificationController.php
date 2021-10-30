<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CertificationController extends AbstractController
{
    /**
     * @Route("/certification", name="certification")
     */
    public function index(): Response
    {
        return $this->render('certification/index.html.twig', [
            'controller_name' => 'CertificationController',
        ]);
    }
}
