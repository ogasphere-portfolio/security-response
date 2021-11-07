<?php

namespace App\Controller;

use App\Entity\Enterprise;
use App\Entity\Member;
use App\Repository\EnterpriseRepository;
use App\Repository\MemberRepository;
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
    public function enterpriseHome(EnterpriseRepository $enterpriseRepository): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser()->getUserEnterprise();
        $annonces = $user->getAnnouncement();

        return $this->render('profile/enterprise/home.html.twig', [
            'enterprise' => $user,
            'annonces' => $annonces,
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
