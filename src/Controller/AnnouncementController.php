<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Announcement;
use App\Entity\Answer;
use App\Form\AnnouncementType;
use App\Form\AnswerType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnnouncementRepository;
use App\Repository\AnswerRepository;
use App\Repository\CategoryRepository;
use App\Security\Voter\AnnoucementVoter;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/annonces", name="announcement_")
 * 
 */
class AnnouncementController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(AnnouncementRepository $announcementRepository, Security $security): Response
    {

        /**
         * @var User
         */
        $user =  $security->getUser();

        if (isset($user)) {

            if (!empty($user->getUserEnterprise())) {
                return $this->render('announcement/browse.html.twig', [
                    'announcement_browse' => $announcementRepository->findByAnnouncementByEnterprise(),

                ]);
            }
            if (!empty($user->getUserMember())) {
                return $this->render('announcement/browse.html.twig', [
                    'announcement_browse' => $announcementRepository->findByRecrutement(),

                ]);
            }
        }
        return $this->render('announcement/browse.html.twig', [
            'announcement_browse' => $announcementRepository->findByAnnouncementByEnterprise()
        ]);
    }

    /**
     *
     * @Route("/{id}/read", name="read")
     */
    public function read($id, AnnouncementRepository $announcementRepository, Request $request, AnswerRepository $answerRepository): Response
    {
        $announcement = $announcementRepository->find($id);

        $answer = new Answer();
        $form = $this->createForm(AnswerType::class);
        $form->setData($answer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $answer = $form->getData();
            // On associe Réponse
            $answer->setAnnouncement($announcement);

            // On associe le user connecté à la réponse
            $answer->setUser($this->getUser());

            // Modifier le comportement de announcement pour que sa propriété $updatedAt soit mise à jour à chaque fois qu'une réponse est postée !
            // $announcement->setUpdatedAt(new DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

            $this->addFlash('success', 'Réponse ajoutée');

            return $this->redirectToRoute('announcement_read', ['id' => $announcement->getId()]);
        }

        $answers = $answerRepository->findBy([
            'announcement' => $announcement,

        ]);


        return $this->render('announcement/read.html.twig', [
            'announcement_read' => $announcement,
            'form' => $form->createView(),
            'answers' => $answers,
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
    public function add(Request $request, Security $security, CategoryRepository $cr, SluggerInterface $slugger): Response
    {
        $announcement = new Announcement();

        $this->denyAccessUnlessGranted(AnnoucementVoter::ADD, $announcement);

        $announcementForm = $this->createForm(AnnouncementType::class, $announcement);
        if (empty($this->getUser())) {

            return $this->redirectToRoute('homepage');
        }

        if (!empty(($this->getUser()))) {
            if (($this->getUser()->getUserEnterprise())) {
                $enterpriseCategory = $cr->findOneBy([
                    'name' => 'Recrutement'
                ]);
                $announcement->setCategory($enterpriseCategory);
                $announcementForm
                    ->add('category', null, [
                        // 'attr' => ['class' => 'd-none'] ,
                        'disabled' => 'disabled',
                    ]);
                $announcement->setEnterprise($this->getUser()->getUserEnterprise());
            }
        }

        $announcementForm->handleRequest($request);

        if ($announcementForm->isSubmitted() && $announcementForm->isValid()) {

            /**
             * @var User
             */
            $user = $security->getUser();
            $announcement->setSlug($slugger->slug($announcement->getTitle()));
            // $announcement->setEnterprise($user->getUserEnterprise());

            // on ne demande l'entityManager que si on en a besoin
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($announcement);
            $entityManager->flush();

            $this->addFlash('success', "L'annonce {$announcement->getTitle()} a été créée");

            if (empty(($this->getUser()))) {
                return $this->redirectToRoute('homepage');
            }

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

        foreach ($announcement->getAnswers() as $currentAnswer) {
            // supprimer le currentAnswer
            $entityManager->remove($currentAnswer);
        }
        $entityManager->remove($announcement);
        $entityManager->flush();

        $this->addFlash('success', "L'annonce {$announcement->getTitle()} a été supprimé");

        return $this->redirectToRoute('profile_enterprise');
    }

    /**
     * @Route("/{id}/postulate", name="postulate", methods={"GET"})
     */
    public function postulate(Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();
        $announcement->addMember($user->getUserMember());

        $entityManager->persist($announcement);
        $entityManager->flush();

        $this->addFlash('success', "L'annonce {$announcement->getTitle()} a postuler");

        return $this->redirectToRoute('announcement_browse');
    }
}
