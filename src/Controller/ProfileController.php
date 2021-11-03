<?php

namespace App\Controller;

use App\Entity\Enterprise;
use App\Entity\Member;
use App\Repository\EnterpriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/entreprise/{id}", name="enterprise", methods={"GET"})
     */
    public function enterpriseHome(Request $request, EnterpriseRepository $enterpriseRepository): Response
    {
        
        return $this->render('profile/enterprise/home.html.twig', [
            'enterprise' => $enterpriseRepository,
        ]);
    }

    /**
     * @Route("/member/{id}", name="member")
     */
    public function memberHome(Request $request, Member $member): Response
    {
        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

        return $this->render('profile/member/home.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $memberForm->createView(),
               
        ]);
    }
}
