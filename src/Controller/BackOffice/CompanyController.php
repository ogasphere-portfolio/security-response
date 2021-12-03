<?php

namespace App\Controller\BackOffice;

use App\Entity\Company;
use App\Form\BackOffice\CompanyType;
use App\Repository\CompanyRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

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

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Company $company): Response
    {

        $companyForm = $this->createForm(CompanyType::class, $company, [
            'disabled' => 'disabled'
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/company/read.html.twig', [
            'company_form' => $companyForm->createView(),
            'company' => $company,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Company $company): Response
    {
        $companyForm = $this->createForm(CompanyType::class, $company);

        $companyForm->handleRequest($request);

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $company->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Company `{$company->getBusinessName()}` udpated successfully");

            return $this->redirectToRoute('backoffice_company_browse');
        }


        return $this->render('backoffice/company/add.html.twig', [
            'company_form' => $companyForm->createView(),
            'company' => $company,
            'page' => 'edit',
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $company = new Company();


        $companyForm = $this->createForm(CompanyType::class, $company);


        $companyForm->handleRequest($request);


        if ($companyForm->isSubmitted() && $companyForm->isValid()) {

            $company->setSlug(strtolower($slugger->slug($company->getBusinessName())));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($company);
            $entityManager->flush();


            $this->addFlash('success', "Company {$company->getBusinessName()} created successfully");


            return $this->redirectToRoute('backoffice_company_browse');
        }


        return $this->render('backoffice/company/add.html.twig', [
            'company_form' => $companyForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete/", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Company $company, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Company {$company->getBusinessName()} deleted");

        $entityManager->remove($company);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_company_browse');
    }
}
