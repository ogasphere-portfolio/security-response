<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
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
    
     /**
     * 
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $member = new Member();

        // on créé un formulaire vierge (sans données initiales car l'objet fournit est vide)
        $memberForm = $this->createForm(MemberType::class, $member);

        // Après avoir été affiché le handleRequest nous permettra
        // de faire la différence entre un affichage de formulaire (en GET) 
        // et une soumission de formulaire (en POST)
        // Si un formulaire a été soumis, il rempli l'objet fournit lors de la création
        $memberForm->handleRequest($request);

        // l'objet de formulaire a vérifié si le formulaire a été soumis grace au HandleRequest
        // l'objet de formulaire vérifie si le formulaire est valide (token csrf mais pas que)
        if ($memberForm->isSubmitted() && $memberForm->isValid()) {

           
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($member);
            $entityManager->flush();

            // pour opquaste 
            $this->addFlash('success', "Le membre `{$member->getFirstName()}` à été ajouté");

            // redirection
            return $this->redirectToRoute('member_list');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'page' => 'create',
        ]);
    }
}
