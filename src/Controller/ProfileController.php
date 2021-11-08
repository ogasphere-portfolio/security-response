<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Member;
use DateTimeImmutable;
use App\Form\MemberType;
use App\Entity\Enterprise;
use App\Form\EnterpriseType;
use App\Form\BackOffice\UserType;
use App\Repository\MemberRepository;
use App\Repository\EnterpriseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profil", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/entreprise/{id}", name="enterprise", methods={"GET"})
     */
    public function enterpriseHome(Request $request, Enterprise $enterprise): Response
    {
        /**
         * 
         */
        $user = $this->getUser()->getUserEnterprise();
        $annonces = $user->getAnnouncement();
        $certifications = $user->getCertification();
        
        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);
        $enterpriseForm->handleRequest($request);

        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->flush();

            $this->addFlash('success', "L'entreprise {$enterprise->getBusinessName()} à été modifié");

            return $this->redirectToRoute('enterprise');
        }

        return $this->render('profile/enterprise/home.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'enterprise' => $user,
            'annonces' => $annonces,
            'certifications' => $certifications,
        ]);
    }

    /**
     * @Route("/membre", name="member", methods={"GET"})
     */
    public function memberHome(Security $security): Response
    {
        $userMember = $security->getUser();
        $userMember->getUserMember()->getFirstName();

        $member = $userMember->getUserMember();

        return $this->render('profile/member/home.html.twig', [
            'member' => $member,
        ]);
    }

}
