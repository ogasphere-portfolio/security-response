<?php

namespace App\Controller;

use App\Entity\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @Route("/company", name="company")
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('company/index.html.twig', [
            'controller_name' => 'CompanyController',
        ]);
    }
}
