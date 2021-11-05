<?php

namespace App\Controller;

use App\Entity\Enterprise;
use App\Entity\Member;
use App\Entity\User;
use App\Form\BackOffice\UserType;
use App\Form\MemberType;
use App\Repository\EnterpriseRepository;
use App\Repository\MemberRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/profil", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/entreprise", name="enterprise", methods={"GET"})
     */
    public function enterpriseHome(EnterpriseRepository $enterpriseRepository): Response
    {
        $userEnterprise = $this->getUser();

        return $this->render('profile/enterprise/home.html.twig', [
            'enterprise' => $userEnterprise,
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
            'member' => $userMember,
        ]);
    }

}
