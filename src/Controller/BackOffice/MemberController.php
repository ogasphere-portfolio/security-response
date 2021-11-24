<?php

namespace App\Controller\BackOffice;

use App\Entity\Member;
use App\Form\BackOffice\MemberType;
use App\Repository\MemberRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/membre", name="backoffice_member_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class MemberController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(MemberRepository $memberRepository): Response
    {

        return $this->render('backoffice/member/browse.html.twig', [
            'member_list' => $memberRepository->findAll(),
            'controller_name' => 'BackOffice/MemberController'
        ]);
    }

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Member $member): Response
    {

        $memberForm = $this->createForm(MemberType::class, $member, [
            'disabled' => 'disabled'
        ]);



        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/member/read.html.twig', [
            'form' => $memberForm->createView(),
            'member' => $member,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Member $member): Response
    {


        // $member->getAnnouncements(); //get the annoucements of the member
        $memberForm = $this->createForm(MemberType::class, $member);


        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Permet de sauvegarder les annonces des membres
            foreach ($member->getAnnouncements() as $announce) {
                $announce->addMember($member);
            }

            
            $entityManager->flush();

            $this->addFlash('success', "Le membre {$member->getFirstname()} {$member->getLastname()} à été modifié");

            return $this->redirectToRoute('backoffice_member_browse');
        }


        return $this->render('backoffice/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'member' => $member,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $member = new Member();


        $memberForm = $this->createForm(MemberType::class, $member);


        $memberForm->handleRequest($request);


        if ($memberForm->isSubmitted() && $memberForm->isValid()) {

            $member->setSlug(strtolower($slugger->slug($member->getFirstname() . '-' . $member->getLastname())));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($member);
            $entityManager->flush();


            $this->addFlash('success', "Member {$member->getFirstname()} {$member->getLastname()} created successfully");


            return $this->redirectToRoute('backoffice_member_browse');
        }


        return $this->render('backoffice/member/add.html.twig', [
            'form' => $memberForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Member $member, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Member {$member->getId()} deleted");

        $entityManager->remove($member);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_member_browse');
    }
}
