<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @Route("/annonces", name="announcement")
     */
    public function index(): Response
    {
        return $this->render('announcement/index.html.twig', [
            'controller_name' => 'AnnouncementController',
        ]);
    }
}
