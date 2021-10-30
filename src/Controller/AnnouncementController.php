<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/annonces", name="announcement_")
     */
class AnnouncementController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render('announcement/browse.html.twig', [
            'announcement_list' => $announcementRepository->findAll()
        ]);
    }

    /**
     *
     * @Route("/edit/{id}", name="read")
     */
    public function read($id, AnnouncementRepository $announcementRepository): Response
    {
        $announcement = $announcementRepository->find($id);
      
        return $this->render('announcement/read.html.twig', [
            'announcement_read' => $announcement,
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $announcement = new Announcement();

        // on créé un formulaire vierge (sans données initiales car l'objet fournit est vide)
        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);

        // Après avoir été affiché le handleRequest nous permettra
        // de faire la différence entre un affichage de formulaire (en GET) 
        // et une soumission de formulaire (en POST)
        // Si un formulaire a été soumis, il rempli l'objet fournit lors de la création
        $announcementForm->handleRequest($request);

        // l'objet de formulaire a vérifié si le formulaire a été soumis grace au HandleRequest
        // l'objet de formulaire vérifie si le formulaire est valide (token csrf mais pas que)
        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {

            // on ne demande l'entityManager que si on en a besoin
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($announcement);
            $entityManager->flush();
            
            // redirection
            return $this->redirectToRoute('announcement_list');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('announcement/add.html.twig', [
            'announcement_form' => $announcementForm->createView()
        ]);
    }
}