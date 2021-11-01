<?php

namespace App\Controller\BackOffice;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backoffice", name="backoffice_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function browse(): Response
    {
        return $this->render('backoffice/main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
