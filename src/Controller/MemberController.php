<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Specialization;
use App\Entity\User;
use App\Form\UserType;
use App\Form\MemberType;
use App\Form\SpecializationType;
use App\Repository\MemberRepository;
use App\Repository\SpecializationRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

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
        $memberList = $memberRepository->findAll();
        
        return $this->render('member/browse.html.twig', [
            'member_list' => $memberList
        ]);       
    }
    
    /**
     * @Route("/edit/connexion", name="edit_connexion", methods={"GET", "POST"})
     */
    public function editConnexion(Request $request, Security $security, UserPasswordHasherInterface $passwordHasher): Response
    {
        /**
         * @var User
         */
        $userMember = $security->getUser();
        $userMember->getUserMember()->getFirstName();

        $memberForm = $this->createForm(UserType::class, $userMember);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();            
            
            $entityManager->flush();

            $this->addFlash('success', "Les infos de connexions ont été modifiées");

            return $this->redirectToRoute('member_edit_connexion');
        }
        
        if($request->isMethod('POST')) {

            // Verification if the two submit password are equal
            if($request->request->get('pass') == $request->request->get('pass2')) {

                $hashedPassword = $passwordHasher->hash($userMember, $request->request->get('pass'));
                $userMember->setPassword($hashedPassword);

                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('message', "Le mot de passe à été modifié.");

                return $this->redirectToRoute('member_edit_connexion');

            } else {
                $this->addFlash('error', "Les deux mots de passes ne sont pas identiques.");
            }
            
        }

        return $this->render('profile/member/editConnexion.html.twig', [
            'user_form' => $memberForm->createView(),
            'member' => $security,
        ]);
    }

    /**
     * @Route("/edit/infospersonnelles", name="edit_perso", methods={"GET", "POST"})
     */
    public function editPerso(Request $request, Security $security): Response
    {
        /**
         * @var \App\Entity\User
         */
        $userMember = $security->getUser();
        $member = $userMember->getUserMember();

        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->flush();

            $this->addFlash('success', "Les infos personnelles ont été modifiées");

            return $this->redirectToRoute('member_edit_perso');
        }

        

        return $this->render('profile/member/editPerso.html.twig', [            
            'member_form' => $memberForm->createView(),
            'member' => $security,
        ]);
    }

    /**
     * @Route("/edit/specialisations", name="edit_specialization", methods={"GET", "POST"})
     */
    public function editSpecialization(Request $request, Security $security): Response
    {
        /**
         * @var \App\Entity\User
         */
        $userMember = $security->getUser();
        $member = $userMember->getUserMember();

        $specializationForm = $this->createForm(MemberType::class, $member, [
            'type' => 'specialization'
        ]);

        $specializationForm->handleRequest($request);

        if ($specializationForm->isSubmitted() && $specializationForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Read all specializations of the member
            foreach ($member->getSpecialization() as $specialization) {
                $specialization->addMember($member);
            }

            $entityManager->flush();

            $this->addFlash('success', "Les spécialisations ont été modifiées.");

            return $this->redirectToRoute('profile_member');
        }

        return $this->render('profile/member/editSpecializations.html.twig', [            
            'specialization_form' => $specializationForm->createView(),
        ]);
    }

     /**
     * 
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $member = new Member();

        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

            if ($memberForm->isSubmitted() && $memberForm->isValid()) {

                
                $member = $memberForm->getData();
                
                // On associe le user connecté à la question
                $member->setUser($this->getUser());
                
                $member->setSlug(strtolower($slugger->slug($member->getFirstname() . '-' . $member->getLastname())));
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
     * @Route("/delete", name="delete", methods={"GET"})
     */
    public function delete(Security $security, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        /**
         * @var \App\Entity\User
         */
        $userMember = $security->getUser();
        $member = $userMember->getUserMember();

        $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()} à été supprimé");
         
        // logout of current user
        $tokenStorage->setToken();

        $entityManager->remove($member);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
     /**
     *
     * @Route("/{id}/read", name="read")
     */
    public function read($id, MemberRepository $memberRepository): Response
    {
        $member = $memberRepository->find($id);

        return $this->render('member/read.html.twig', [
            'member_read' => $member,
        ]);        
    }


}
