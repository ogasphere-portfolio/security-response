<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Form\UserType;
use App\Repository\companyRepository;
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
 * @Route("/profil/company", name="company_")
 */
class CompanyController extends AbstractController
{
    /**
     * 
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read($id, CompanyRepository $companyRepository): Response
    {

        $company = $companyRepository->find($id);

        $companyForm = $this->createForm(CompanyType::class, $company, [
            'disabled' => 'disabled'
        ]);

        return $this->render('company/read.html.twig', [
            'company_form' => $companyForm->createView(),
            'company' => $company,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Company $company): Response
    {
        $companyForm = $this->createForm(companyType::class, $company);

        $companyForm->handleRequest($request);

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $company->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "L'entreprise {$company->getBusinessName()} à été modifié");

            return $this->redirectToRoute('company_browse');
        }


        return $this->render('company/add.html.twig', [
            'company_form' => $companyForm->createView(),
            'company' => $company,
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
        $usercompany = $security->getUser();
        $usercompany->getUsercompany()->getBusinessName();

        $companyForm = $this->createForm(UserType::class, $usercompany);

        $companyForm->handleRequest($request);

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $this->addFlash('success', "Les infos de connexions ont été modifiées");

            return $this->redirectToRoute('profile_company');
        }

        if ($request->isMethod('POST')) {

            // Verification if the two submit password are equal
            if ($request->request->get('pass') == $request->request->get('pass2')) {

                $hashedPassword = $passwordHasher->hash($usercompany, $request->request->get('pass'));
                $usercompany->setPassword($hashedPassword);

                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('message', "Le mot de passe à été modifié.");

                return $this->redirectToRoute('profile_company');
            } else {
                $this->addFlash('error', "Les deux mots de passes ne sont pas identiques.");
            }
        }

        return $this->render('profile/company/editConnexion.html.twig', [
            'user_form' => $companyForm->createView(),
            'company' => $security,
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
        $usercompany = $security->getUser();
        $company = $usercompany->getUsercompany();

        $companyForm = $this->createForm(companyType::class, $company);

        $companyForm->handleRequest($request);

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $this->addFlash('success', "Les coordonnées ont été modifiées");

            return $this->redirectToRoute('profile_company');
        }


        return $this->render('profile/company/editPerso.html.twig', [
            'company_form' => $companyForm->createView(),
            'company' => $security,
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
        $usercompany = $security->getUser();
        $company = $usercompany->getUsercompany();

        $certificationForm = $this->createForm(companyType::class, $company, [
            'type' => 'certification'
        ]);

        $certificationForm->handleRequest($request);

        if ($certificationForm->isSubmitted() && $certificationForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Read all certifications of the company
            foreach ($company->getCertification() as $certification) {
                $certification->addcompany($company);
            }

            $entityManager->flush();

            $this->addFlash('success', "Les certifications ont été modifiées.");

            return $this->redirectToRoute('profile_company');
        }

        return $this->render('profile/company/editCertification.html.twig', [
            'certification_form' => $certificationForm->createView(),
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, SluggerInterface $slugger): Response
    {
        $company = new company();


        $companyForm = $this->createForm(companyType::class, $company);

        $companyForm->handleRequest($request);


        if ($companyForm->isSubmitted() && $companyForm->isValid()) {

            $companyUser = $companyForm->getData();
            $company->setSlug(strtolower($slugger->slug($company->getBusinessName())));

            // On associe le user connecté à la question
            $companyUser->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($company);
            $entityManager->flush();

            //  opquast 
            $this->addFlash('success', "L'company `{$company->getBusinessName()}` a été ajouté");

            // redirection
            return $this->redirectToRoute('company_browse');
        }

        return $this->render('company/add.html.twig', [
            'company_form' => $companyForm->createView(),
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
        $usercompany = $security->getUser();
        $company = $usercompany->getUsercompany();

        $this->addFlash('success', "L'entreprise' {$company->getBusinessName()} à été supprimée");

        // logout of current user
        $tokenStorage->setToken();

        $entityManager->remove($company);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
