<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/backoffice/company", name="backoffice_company_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('backoffice/company/browse.html.twig', [
            'company_list' => $companyRepository->findAll()

        ]);
    }
}
