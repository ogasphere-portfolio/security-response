<?php

namespace App\Controller;

use App\Entity\Enterprise;
use App\Form\EnterpriseType;
use App\Repository\EnterpriseRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Les annotations de routes au niveau de la classe servent de préfixe à toutes les routes définies dans celle ci
 * 
 * @Route("/profil/entreprise", name="enterprise_")
 */
class EnterpriseController extends AbstractController
{
    /**
     * @Route("/liste", name="browse", methods={"GET"})
     */
    public function browse(Request $request, EnterpriseRepository $EnterpriseRepository): Response
    {
        // Recover the input in the search bar enterprise
        $searchEnterprise = $request->query->get('searchEnterprise');

        if ($searchEnterprise != null) {
            // Use the method searchByCity in EnterpriseRepository to search enterprise by city
            $resultByCity = $EnterpriseRepository->searchByCity($searchEnterprise);

        } else {
            $resultByCity = null;
        }

        return $this->render('enterprise/browse.html.twig', [
            'result_form' => $resultByCity,
            'search_form' => $searchEnterprise
        ]);
    }

    /**
     * @Route("/", name="search_enterprise", methods={"POST"})
     */
    public function searchEnterprise(Request $request, EnterpriseRepository $EnterpriseRepository): Response
    {
        // Recover the input in the search bar enterprise
        $searchEnterprise = $request->request->get('searchEnterprise');

        // Use the method searchByCity in EnterpriseRepository to search enterprise by city
        $resultByCity = $EnterpriseRepository->searchByCity($searchEnterprise);

        // return $this->redirectToRoute('enterprise_list');

        return $this->renderForm('enterprise/browse.html.twig', [
            'result_form' => $resultByCity,
            'search_form' => $searchEnterprise
        ]);
    }

    /**
     * 
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read($id, EnterpriseRepository $EnterpriseRepository): Response
    {

        $enterprise = $EnterpriseRepository->find($id);

        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise, [
            'disabled' => 'disabled'
        ]);

        return $this->render('enterprise/read.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'enterprise' => $enterprise,
        ]);
    }    

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Enterprise $enterprise): Response
    {
        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);

        $enterpriseForm->handleRequest($request);

        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $enterprise->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "L'entreprise {$enterprise->getBusinessName()} à été modifié");

            return $this->redirectToRoute('enterprise_browse');
        }

        
        return $this->render('enterprise/add.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'enterprise' => $enterprise,
            'page' => 'edit',
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $enterprise = new Enterprise();


        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);

        $enterpriseForm->handleRequest($request);


        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {

            $enterpriseUser = $enterpriseForm->getData();

            // On associe le user connecté à la question
            $enterpriseUser->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($enterprise);
            $entityManager->flush();

            //  opquast 
            $this->addFlash('success', "L'enterprise `{$enterprise->getBusinessName()}` a été ajouté");

            // redirection
            return $this->redirectToRoute('enterprise_browse');
        }

        return $this->render('enterprise/add.html.twig', [
            'enterprise_form' => $enterpriseForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Enterprise $enterprise, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "L'entreprise {$enterprise->getBusinessName()} à été supprimé");

        $entityManager->remove($enterprise);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
