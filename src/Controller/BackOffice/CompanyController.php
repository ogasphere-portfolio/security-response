<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @Route("/backoffice/company", name="backoffice_company")
     */
    public function index(): Response
    {
        return $this->render('backoffice/company/index.html.twig', [
            'controller_name' => 'CompanyController',
        ]);
    }
}
