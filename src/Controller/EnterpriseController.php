<?php

namespace App\Controller;

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
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(): Response
    {
        return $this->render('enterprise/list.html.twig', [
            'controller_name' => 'EnterpriseController',
        ]);
    }
     /**
     * 
     * @Route("/{id}", name="read")
     */
    public function read($id,EnterpriseRepository $EnterpriseRepository ): Response
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

        return $this->redirectToRoute('enterprise_list');
                    
        return $this->renderForm('enterprise/list.html.twig', [
            'result_form' => $resultByCity,
            'search_form' => $searchEnterprise
        ]);
    }

}

