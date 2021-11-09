<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Announcement;
use App\Form\AnnouncementType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnnouncementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
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
    public function browse(AnnouncementRepository $announcementRepository ,Security $security): Response
    {

         /**
         * @var User
         */
        $user =  $security->getUser();

        if ($user->getUserEnterprise() === null)

        {
            return $this->render('announcement/browse.html.twig', [
                'announcement_browse' => $announcementRepository->findByRecrutement(),
               
            ]);
        }
        if ($user->getUserEnterprise() === null){
            return $this->render('announcement/browse.html.twig', [
            'announcement_browse' => $announcementRepository->findByAnnouncementByEnterprise(),
               
            ]);
        }
        
       
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
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Announcement $announcement): Response
    {
        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);

        $announcementForm->handleRequest($request);

        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();            
           
            $entityManager->flush();

            $this->addFlash('success', "L'annonce `{$announcement->getTitle()}` a été modifiée");

            return $this->redirectToRoute('profile_enterprise');
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
         
        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);

        $announcementForm->handleRequest($request);

        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {

            /**
            * @var User
            */            
            $user = $security->getUser();

            $announcement->setEnterprise($user->getUserEnterprise());

            // on ne demande l'entityManager que si on en a besoin
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($announcement);
            $entityManager->flush();

            $this->addFlash('success', "L'annonce {$announcement->getTitle()} a été créée");
            
            // redirection
            return $this->redirectToRoute('profile_enterprise');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('announcement/add.html.twig', [
            'announcement_form' => $announcementForm->createView(),
            'page' => 'create'
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"})
     */
    public function delete(Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        
        $entityManager->remove($announcement);
        $entityManager->flush();

        $this->addFlash('success', "L'annonce {$announcement->getTitle()} a été supprimé");

        return $this->redirectToRoute('profile_enterprise');
    }
}