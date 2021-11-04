<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/membre", name="member_")
*/
class MemberController extends AbstractController
{
    
    /**
     * @Route("/", name="browse")
     */
    public function browse(MemberRepository $memberRepository): Response
    {
        return $this->render('member/browse.html.twig', [
            'member_browse' => $memberRepository->findAll()
        ]);
    }

     /**
     * 
     * @Route("/read/{id}", name="read", methods={"GET"})
     */
    public function read($id, MemberRepository $MemberRepository ): Response
    { 
       
        $member = $MemberRepository->find($id);

        $memberForm = $this->createForm(MemberType::class, $member, [
            'disabled' => 'disabled'
        ]);

        return $this->render('member/read.html.twig', [
            'member_form' => $memberForm->createView(),
            'member' => $member,
        ]);
    }
    
    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Member $member): Response
    {
        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            
            $entityManager->flush();

            $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()}  à été modifié");

            return $this->redirectToRoute('member_browse');
        }

        
        return $this->render('member/add.html.twig', [
            'form' => $memberForm->createView(),
            'member' => $member,
            'page' => 'edit',
        ]);
    }
     /**
     * 
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $member = new Member();

       
        $memberForm = $this->createForm(MemberType::class, $member);

        $memberForm->handleRequest($request);

            if ($memberForm->isSubmitted() && $memberForm->isValid()) {

           
                $member = $memberForm->getData();

                // On associe le user connecté à la question
                $member->setUser($this->getUser());
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($member);
                $entityManager->flush();
    
                $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()} à été ajouté");
    
                return $this->redirectToRoute('member_list', ['id' => $member->getId()]);

           
        }

        // on fournit ce formulaire à notre vue
        return $this->render('/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'page' => 'create',
        ]);
    }
}
