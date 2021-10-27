<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/members", name="member_")
*/
class MemberController extends AbstractController
{
    
    /**
     * @Route("/", name="list")
     */
    public function list(): Response
    {
        return $this->render('member/list.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
     /**
     * 
     * @Route("/{id}", name="read")
     */
    public function read($id,MemberRepository $MemberRepository ): Response
    { 
       
        $member = $MemberRepository->find($id);
      
        return $this->render('member/read.html.twig', [
            'member_read' => $member,
        ]);
    }
}
