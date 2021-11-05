<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\User;
use App\Form\BackOffice\UserType;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/profil/membre", name="member_")
*/
class MemberController extends AbstractController
{
    
    /**
     * @Route("/liste", name="browse")
     */
    public function browse(MemberRepository $memberRepository): Response
    {
        return $this->render('member/browse.html.twig', [
            'member_browse' => $memberRepository->findAll()
        ]);
    }

    
    /**
     * @Route("/edit/connexion", name="edit_connexion", methods={"GET", "POST"})
     */
    public function editConnexion(Request $request, Security $security, UserType $userType): Response
    {
        $userMember = $security->getUser();
        $userMember->getUserMember()->getFirstName();

        $memberForm = $this->createForm(UserType::class, $userMember);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $userMember->setUpdatedAt(new DateTime());
            $entityManager->flush();

            $this->addFlash('success', "Les infos de connexions ont été modifiées");

            return $this->redirectToRoute('profile_member');
        }
        
        $member = $userMember->getUserMember();

        $memberForm = $this->createForm(MemberType::class, $member, [
            'disabled' => 'disabled'
        ]);

        return $this->render('profile/member/home.html.twig', [
            'user_form' => $memberForm->createView(),
            'member_form' => $memberForm->createView(),
            'member' => $security,
        ]);
    }

    /**
     * @Route("/edit/infospersonnelles", name="edit_perso", methods={"GET", "POST"})
     */
    public function editPerso(Request $request, Security $security, MemberType $memberType): Response
    {
        $member = $security->getUser();
        $member->getUserMember()->getFirstName();

        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $member->setUpdatedAt(new DateTime());
            $entityManager->flush();

            $this->addFlash('success', "Les infos personnelles ont été modifiées");

            return $this->redirectToRoute('profile_member');
        }

        return $this->render('profile/member/home.html.twig', [            
            'member_form' => $memberForm->createView(),
            'member' => $security,
        ]);
    }

     /**
     * 
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $member = new Member();

       
        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

            if ($memberForm->isSubmitted() && $memberForm->isValid()) {

           
                $member = $memberForm->getData();

                // On associe le user connecté à la question
                $member->setUser($this->getUser());
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($member);
                $entityManager->flush();
    
                $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()} à été ajouté");
    
                return $this->redirectToRoute('member_browse', ['id' => $member->getId()]);

           
        }

        // on fournit ce formulaire à notre vue
        return $this->render('profile/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Member $member, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()} à été supprimé");

        $entityManager->remove($member);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
