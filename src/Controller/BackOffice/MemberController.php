<?php

namespace App\Controller\BackOffice;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/member", name="backoffice_member_")
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
            'member_browse' => $memberRepository->findAll(),
            'controller_name' => 'BackOffice/MemberController'
        ]);
    }

    /**
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Member $member): Response
    {

        $memberForm = $this->createForm(MemberType::class, $member, [
            'disabled' => 'disabled'
        ]);

        $memberForm
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/member/read.html.twig', [
            'form' => $memberForm->createView(),
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

            $member->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Member {$member->getFirstname()} {$member->getLastname()} udpated successfully");

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
    public function add(Request $request): Response
    {
        $member = new Member();


        $memberForm = $this->createForm(MemberType::class, $member);


        $memberForm->handleRequest($request);


        if ($memberForm->isSubmitted() && $memberForm->isValid()) {


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
