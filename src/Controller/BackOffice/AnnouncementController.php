<?php

namespace App\Controller\BackOffice;

use App\Entity\Announcement;
use App\Form\BackOffice\AnnouncementType;
use App\Repository\AnnouncementRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/announcement", name="backoffice_announcement_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class AnnouncementController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(AnnouncementRepository $announcementRepository): Response
    {
        
        return $this->render('backoffice/announcement/browse.html.twig', [
            'announcement_list' => $announcementRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Announcement $announcement): Response
    {

        $announcementForm = $this->createForm(AnnouncementType::class, $announcement, [
            'disabled' => 'disabled'
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/announcement/read.html.twig', [
            'announcement_form' => $announcementForm->createView(),
            'announcement' => $announcement,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Announcement $announcement): Response
    {
        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);

        $announcementForm->handleRequest($request);
       
       
        
       
        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

           
            $entityManager->flush();

            $this->addFlash('success', "Announcement `{$announcement->getTitle()}` udpated successfully");

            return $this->redirectToRoute('backoffice_announcement_browse');
        }


        return $this->render('backoffice/announcement/add.html.twig', [
            'announcement_form' => $announcementForm->createView(),
            'announcement' => $announcement,
            'page' => 'edit',
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $announcement = new Announcement();


        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);


        $announcementForm->handleRequest($request);


        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {

            $announcement->setSlug($slugger->slug($announcement->getTitle()));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($announcement);
            $entityManager->flush();


            $this->addFlash('success', "Announcement {$announcement->getTitle()} created successfully");


            return $this->redirectToRoute('backoffice_announcement_browse');
        }


        return $this->render('backoffice/announcement/add.html.twig', [
            'announcement_form' => $announcementForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Announcement {$announcement->getTitle()} deleted");

        foreach($announcement->getAnswers() as $currentAnswer) {
            // supprimer le currentAnswer
            $entityManager->remove($currentAnswer);
            }
        $entityManager->remove($announcement);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_announcement_browse');
    }
}
