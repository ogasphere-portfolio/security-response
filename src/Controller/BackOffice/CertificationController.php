<?php

namespace App\Controller\BackOffice;

use App\Entity\Certification;
use App\Form\BackOffice\CertificationType;
use App\Repository\CertificationRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/certification", name="backoffice_certification_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class CertificationController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(CertificationRepository $certificationRepository): Response
    {

        return $this->render('backoffice/certification/browse.html.twig', [
            'certification_list' => $certificationRepository->findAll(),
            'controller_name' => 'BackOffice/CertificationController'
        ]);
    }

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Certification $certification): Response
    {

        $certificationForm = $this->createForm(CertificationType::class, $certification, [
            'disabled' => 'disabled'
        ]);

        
        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/certification/read.html.twig', [
            'form' => $certificationForm->createView(),
            'certification' => $certification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Certification $certification): Response
    {
        $certificationForm = $this->createForm(CertificationType::class, $certification);

        $certificationForm->handleRequest($request);

        if ($certificationForm->isSubmitted() && $certificationForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            
            foreach ($certification->getEnterprises() as $enterprise) {
                $enterprise->addCertification($certification);
            }

            $certification->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Certification `{$certification->getName()}` udpated successfully");

            return $this->redirectToRoute('backoffice_certification_browse');
        }


        return $this->render('backoffice/certification/add.html.twig', [
            'form' => $certificationForm->createView(),
            'certification' => $certification,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $certification = new Certification();


        $certificationForm = $this->createForm(CertificationType::class, $certification);


        $certificationForm->handleRequest($request);


        if ($certificationForm->isSubmitted() && $certificationForm->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($certification);
            $entityManager->flush();


            $this->addFlash('success', "Certification {$certification->getName()} created successfully");


            return $this->redirectToRoute('backoffice_certification_browse');
        }


        return $this->render('backoffice/certification/add.html.twig', [
            'form' => $certificationForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Certification $certification, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Certification {$certification->getName()} deleted");

        $entityManager->remove($certification);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_certification_browse');
    }
}
