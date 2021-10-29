<?php

namespace App\Controller;

use App\Repository\AnnouncementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/annonces", name="announcement_")
     */
class AnnouncementController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render('announcement/list.html.twig', [
            'announcement_list' => $announcementRepository->findAll()
        ]);
    }
}
