<?php

namespace App\Controller;

use App\Repository\EnterpriseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/entreprises", name="enterprise_")
*/
class EnterpriseController extends AbstractController
{
    /**
     * @Route("/", name="list")
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
     * @Route("/", name="list_by_city")
     */
    public function findAllWithCity($enterprises): Response
    {
        return $this->render('enterprise/list.html.twig', [
            'enterprise_list' => $enterprises,
        ]);
    }

}

