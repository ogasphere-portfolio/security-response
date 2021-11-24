<?php

namespace App\Controller;

use App\Entity\Enterprise;
use App\Form\EnterpriseType;
use App\Form\UserType;
use App\Repository\EnterpriseRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

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
     * @Route("/edit/connexion", name="edit_connexion", methods={"GET", "POST"})
     */
    public function editConnexion(Request $request, Security $security, UserPasswordHasherInterface $passwordHasher): Response
    {
        /**
         * @var User
         */
        $userEnterprise = $security->getUser();
        $userEnterprise->getUserEnterprise()->getBusinessName();

        $enterpriseForm = $this->createForm(UserType::class, $userEnterprise);

        $enterpriseForm->handleRequest($request);

        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();            
            
            $entityManager->flush();

            $this->addFlash('success', "Les infos de connexions ont été modifiées");

            return $this->redirectToRoute('profile_enterprise');
        }
        
        if($request->isMethod('POST')) {

            // Verification if the two submit password are equal
            if($request->request->get('pass') == $request->request->get('pass2')) {

                $hashedPassword = $passwordHasher->hash($userEnterprise, $request->request->get('pass'));
                $userEnterprise->setPassword($hashedPassword);

                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('message', "Le mot de passe à été modifié.");

                return $this->redirectToRoute('profile_enterprise');

            } else {
                $this->addFlash('error', "Les deux mots de passes ne sont pas identiques.");
            }
            
        }

        return $this->render('profile/enterprise/editConnexion.html.twig', [
            'user_form' => $enterpriseForm->createView(),
            'enterprise' => $security,
        ]);
    }

    /**
     * @Route("/edit/infospersonnelles", name="edit_perso", methods={"GET", "POST"})
     */
    public function editPerso(Request $request, Security $security): Response
    {
        /**
         * @var \App\Entity\User
         */
        $userEnterprise = $security->getUser();
        $enterprise = $userEnterprise->getUserEnterprise();

        $enterpriseForm = $this->createForm(EnterpriseType::class, $enterprise);

        $enterpriseForm->handleRequest($request);

        if ($enterpriseForm->isSubmitted() && $enterpriseForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->flush();

            $this->addFlash('success', "Les coordonnées ont été modifiées");

            return $this->redirectToRoute('profile_enterprise');
        }
                    

        return $this->render('profile/enterprise/editPerso.html.twig', [            
            'enterprise_form' => $enterpriseForm->createView(),
            'enterprise' => $security,
        ]);
    }

    /**
     * @Route("/edit/certifications", name="edit_certification", methods={"GET", "POST"})
     */
    public function editCertification(Request $request, Security $security): Response
    {
        /**
         * @var \App\Entity\User
         */
        $userEnterprise = $security->getUser();
        $enterprise = $userEnterprise->getUserEnterprise();

        $certificationForm = $this->createForm(EnterpriseType::class, $enterprise, [
            'type' => 'certification'
        ]);

        $certificationForm->handleRequest($request);

        if ($certificationForm->isSubmitted() && $certificationForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Read all certifications of the enterprise
            foreach ($enterprise->getCertification() as $certification) {
                $certification->addEnterprise($enterprise);
            }

            $entityManager->flush();

            $this->addFlash('success', "Les certifications ont été modifiées.");

            return $this->redirectToRoute('profile_enterprise');
        }

        return $this->render('profile/enterprise/editCertification.html.twig', [            
            'certification_form' => $certificationForm->createView(),
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

            $enterpriseUser = $enterpriseForm->getData();
            $enterprise->setSlug(strtolower($slugger->slug($enterprise->getBusinessName())));

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
     * @Route("/delete", name="delete", methods={"GET"})
     */
    public function delete(Security $security, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        /**
         * @var \App\Entity\User
         */
        $userEnterprise = $security->getUser();
        $enterprise = $userEnterprise->getUserEnterprise();

        $this->addFlash('success', "L'entreprise' {$enterprise->getBusinessName()} à été supprimée");

        // logout of current user
        $tokenStorage->setToken();

        $entityManager->remove($enterprise);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
