<?php

namespace App\Controller;

use App\Entity\Enterprise;
use App\Form\EnterpriseType;
use App\Repository\EnterpriseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/entreprises", name="enterprise_")
 */
class EnterpriseController extends AbstractController
{
    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(Request $request, EnterpriseRepository $EnterpriseRepository): Response
    {
        // Recover the input in the search bar enterprise
        $searchEnterprise = $request->query->get('searchEnterprise');

        if ($searchEnterprise != null) {
            // Use the method searchByCity in EnterpriseRepository to search enterprise by city
            $resultByCity = $EnterpriseRepository->searchByCity($searchEnterprise);

        } else {
            $resultByCity = null;
        }

        return $this->render('enterprise/browse.html.twig', [
            'result_form' => $resultByCity,
            'search_form' => $searchEnterprise
        ]);
    }
    /**
     * 
     * @Route("edit/{id}", name="read")
     */
    public function read($id, EnterpriseRepository $EnterpriseRepository): Response
    {

        $enterprise = $EnterpriseRepository->find($id);

        return $this->render('enterprise/read.html.twig', [
            'enterprise_read' => $enterprise,
        ]);
    }

    /**
     * @Route("/", name="search_enterprise", methods={"POST"})
     */
    public function searchEnterprise(Request $request, EnterpriseRepository $EnterpriseRepository): Response
    {
        // Recover the input in the search bar enterprise
        $searchEnterprise = $request->request->get('searchEnterprise');

        // Use the method searchByCity in EnterpriseRepository to search enterprise by city
        $resultByCity = $EnterpriseRepository->searchByCity($searchEnterprise);
var_dump($resultByCity);
        // return $this->redirectToRoute('enterprise_list');

        return $this->renderForm('enterprise/browse.html.twig', [
            'result_form' => $resultByCity,
            'search_form' => $searchEnterprise
        ]);
    }


    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $enterprise = new Enterprise();


        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);

        $enterpriseForm->handleRequest($request);


        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {

            $enterpriseUser = $enterpriseForm->getData();

            // On associe le user connecté à la question
            $enterpriseUser->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($enterprise);
            $entityManager->flush();

            //  opquast 
            $this->addFlash('success', "enterprise `{$enterprise->getBusinessName()}` created successfully");

            // redirection
            return $this->redirectToRoute('enterprise_list');
        }

        return $this->render('enterprise/add.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'page' => 'create',
        ]);
    }
}
