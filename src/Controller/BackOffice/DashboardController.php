<?php

namespace App\Controller\BackOffice;


use App\Repository\AnnouncementRepository;
use App\Repository\EnterpriseRepository;
use App\Repository\MemberRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backoffice", name="backoffice_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(AnnouncementRepository $announcementRepository,EnterpriseRepository $enterpriseRepository,
    MemberRepository $memberRepository, UserRepository $userRepository): Response
    {
        $announcements = $announcementRepository->findAll();
        $announcementNotValid = $announcementRepository->findBy(['status' => 0]);

        $usersNotValid = $userRepository->findBy(['isVerified' => 0]);

       

        $enterprises = $enterpriseRepository->findAll();
        $members = $memberRepository->findAll();

        return $this->render('backoffice/dashboard/home.html.twig', [
            'announcements' => $announcements,
            'enterprises' => $enterprises,
            'members' => $members,
            'announcementNotValid' => $announcementNotValid,
            'usersNotValid' => $usersNotValid,
        ]);
    }
}
