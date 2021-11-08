<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Enterprise;
use App\Form\EnterpriseType;
use App\Repository\MemberRepository;
use App\Repository\EnterpriseRepository;
use Symfony\Component\HttpFoundation\Request;
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
         * @var User
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
     * @Route("/membre/{id}", name="member")
     */
    public function memberHome(MemberRepository $memberRepository): Response
    {
        $userMember = $this->getUser();

        return $this->render('profile/member/home.html.twig', [
            'member' => $userMember,
        ]);
    }
}
