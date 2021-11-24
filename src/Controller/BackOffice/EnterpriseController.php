<?php

namespace App\Controller\BackOffice;

use App\Entity\Enterprise;
use App\Form\BackOffice\EnterpriseType;
use App\Repository\EnterpriseRepository;
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
 * @Route("/backoffice/enterprise", name="backoffice_enterprise_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class EnterpriseController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(EnterpriseRepository $enterpriseRepository): Response
    {

        return $this->render('backoffice/enterprise/browse.html.twig', [
            'enterprise_list' => $enterpriseRepository->findAll()

        ]);
    }

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Enterprise $enterprise): Response
    {

        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise, [
            'disabled' => 'disabled'
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/enterprise/read.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'enterprise' => $enterprise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Enterprise $enterprise): Response
    {
        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);

        $enterpriseForm->handleRequest($request);

        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $enterprise->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Enterprise `{$enterprise->getBusinessName()}` udpated successfully");

            return $this->redirectToRoute('backoffice_enterprise_browse');
        }


        return $this->render('backoffice/enterprise/add.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'enterprise' => $enterprise,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $enterprise = new Enterprise();


        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);


        $enterpriseForm->handleRequest($request);


        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {

            $enterprise->setSlug(strtolower($slugger->slug($enterprise->getBusinessName())));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($enterprise);
            $entityManager->flush();


            $this->addFlash('success', "Enterprise {$enterprise->getBusinessName()} created successfully");


            return $this->redirectToRoute('backoffice_enterprise_browse');
        }


        return $this->render('backoffice/enterprise/add.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete/", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Enterprise $enterprise, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Enterprise {$enterprise->getBusinessName()} deleted");

        $entityManager->remove($enterprise);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_enterprise_browse');
    }
}
