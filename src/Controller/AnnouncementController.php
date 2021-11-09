<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

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
            'announcement_browse' => $announcementRepository->findAll()
        ]);
    }

    /**
     *
     * @Route("/{id}/read", name="read")
     */
    public function read($id, AnnouncementRepository $announcementRepository): Response
    {
        $announcement = $announcementRepository->find($id);
      
        return $this->render('announcement/read.html.twig', [
            'announcement_read' => $announcement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Announcement $announcement): Response
    {
        $announcementForm = $this->createForm(Announcement::class, $announcement);

        $announcementForm->handleRequest($request);

        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();            
           
            $entityManager->flush();

            $this->addFlash('success', "L'annonce `{$announcement->getTitle()}` a été crée");

            return $this->redirectToRoute('enterprise_browse');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('/announcement/add.html.twig', [
            'announcement_form' => $announcementForm->createView(),
            'announcement' => $announcement,
            'page' => 'edit',
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, Security $security): Response
    {
        $announcement = new Announcement();
        /**
        * @var User
        */
        $enterprise = $security->getUser();
        $enterprise->getUserEnterprise()->getBusinessName();
        $userEnterprise = $enterprise->getUserEnterprise();
        
        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);

        $announcementForm->handleRequest($request);

        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {

            $announcement->setEnterprise($userEnterprise);
            // on ne demande l'entityManager que si on en a besoin
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($announcement);
            $entityManager->flush();
            
            // redirection
            return $this->redirectToRoute('announcement_browse');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('announcement/add.html.twig', [
            'announcement_form' => $announcementForm->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "L'annonce a été {$announcement->getId()} deleted");

        $entityManager->remove($announcement);
        $entityManager->flush();

        return $this->redirectToRoute('announcement_browse');
    }
}