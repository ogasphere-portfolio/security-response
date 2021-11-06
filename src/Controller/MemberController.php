<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\BackOffice\MemberType;


use App\Repository\MemberRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/profil/membre", name="member_")
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
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
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
            
            $member->setUpdatedAt(new DateTime());
            $entityManager->flush();

            $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()}  à été modifié");

            return $this->redirectToRoute('member_browse');
        }

        
        return $this->render('member/add.html.twig', [
            'member_form' => $memberForm->createView(),
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
    
                return $this->redirectToRoute('member_browse', ['id' => $member->getId()]);

           
        }

        // on fournit ce formulaire à notre vue
        return $this->render('/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Member $member, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()} à été supprimé");

        $entityManager->remove($member);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
