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
        return $this->render('enterprise/index.html.twig', [
            'controller_name' => 'EnterpriseController',
        ]);
    }
     /**
     * 
     * @Route("/{id}", name="read")
     */
    public function read($id,EnterpriseRepository $EnterpriseRepository ): Response
    { 
        // TODO récupérer trois séries au hasard avec le repository
        $enterprise = $EnterpriseRepository->findBy($id);
        

        return $this->render('tv_show/list.html.twig', [
            'enterprise_list' => $enterprise,
        ]);
    }
    

}

