<?php

namespace App\Controller\BackOffice;

use App\Entity\Specialization;
use App\Form\SpecializationType;
use App\Repository\SpecializationRepository;
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
 * @Route("/backoffice/specialization", name="backoffice_specialization_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class SpecializationController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(SpecializationRepository $specializationRepository): Response
    {

        return $this->render('backoffice/specialization/browse.html.twig', [
            'specialization_list' => $specializationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Specialization $specialization): Response
    {

        $specializationForm = $this->createForm(SpecializationType::class, $specialization, [
            'disabled' => 'disabled'
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/specialization/read.html.twig', [
            'specialization_form' => $specializationForm->createView(),
            'specialization' => $specialization,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Specialization $specialization): Response
    {
        $specializationForm = $this->createForm(SpecializationType::class, $specialization);

        $specializationForm->handleRequest($request);

        if ($specializationForm->isSubmitted() && $specializationForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $specialization->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Specialization `{$specialization->getName()}` udpated successfully");

            return $this->redirectToRoute('backoffice_specialization_browse');
        }


        return $this->render('backoffice/specialization/add.html.twig', [
            'specialization_form' => $specializationForm->createView(),
            'specialization' => $specialization,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $specialization = new Specialization();


        $specializationForm = $this->createForm(SpecializationType::class, $specialization);


        $specializationForm->handleRequest($request);


        if ($specializationForm->isSubmitted() && $specializationForm->isValid()) {

            $specialization->setSlug(strtolower($slugger->slug($specialization->getName())));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($specialization);
            $entityManager->flush();


            $this->addFlash('success', "Specialization `{$specialization->getName()}` created successfully");


            return $this->redirectToRoute('backoffice_specialization_browse');
        }


        return $this->render('backoffice/specialization/add.html.twig', [
            'specialization_form' => $specializationForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Specialization $specialization, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Specialization {$specialization->getName()} deleted");

        $entityManager->remove($specialization);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_specialization_browse');
    }
}
