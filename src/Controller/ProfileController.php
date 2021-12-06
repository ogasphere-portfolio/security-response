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
     * @Route("/entreprise/", name="enterprise", methods={"GET"})
     */
    public function enterpriseHome(Security $security): Response
    {
        /**
         * @var User
         */
        $userEnterprise =  $security->getUser();
        $userEnterprise->getUserEnterprise()->getBusinessName();

        return $this->render('profile/enterprise/home.html.twig', [
            'enterprise' => $userEnterprise,
        ]);
    }
    /**
     * @Route("/societe/", name="company", methods={"GET"})
     */
    public function companyHome(Security $security): Response
    {
        /**
         * @var User
         */
        $userCompany =  $security->getUser();
        $userCompany->getUserCompany()->getBusinessName();

        return $this->render('profile/company/home.html.twig', [
            'compagny' => $userCompany,
        ]);
    }

    /**
     * @Route("/membre", name="member", methods={"GET"})
     */
    public function memberHome(Security $security): Response
    {
        /**
         * @var User
         */
        $userMember = $security->getUser();
        $userMember->getUserMember()->getFirstName();
        return $this->render('profile/member/home.html.twig', [
            'member' => $userMember,
        ]);
    }
}
