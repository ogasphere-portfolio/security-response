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
    public function list(Request $request, EnterpriseRepository $EnterpriseRepository): Response
    {
        // Recover the input in the search bar enterprise
        $searchEnterprise = $request->query->get('searchEnterprise');

        if ($searchEnterprise != null) {
            // Use the method searchByCity in EnterpriseRepository to search enterprise by city
            $resultByCity = $EnterpriseRepository->searchByCity($searchEnterprise);

        } else {
            $resultByCity = null;
        }

        return $this->render('enterprise/list.html.twig', [
            'result_form' => $resultByCity,
            'search_form' => $searchEnterprise
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

}

