<?php

namespace App\Controller\BackOffice;

use App\Entity\User;
use App\Form\BackOffice\UserType;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/user", name="backoffice_user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     * @IsGranted("ROLE_USER_BROWSE")
     */
    public function browse(UserRepository $userRepository): Response
    {
        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/user/browse.html.twig', [
            'user_list' => $userRepository->findAll()
        ]);
    }

     /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER_READ")
     * */
    public function read(Request $request, User $user): Response
    {
       
        $userForm = $this->createForm(UserType::class, $user, [
            'disabled' => 'disabled'
        ]);


        
        return $this->render('backoffice/user/read.html.twig', [
            'user_form' => $userForm->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER_EDIT")
     */
    public function edit(Request $request, User $user, UserPasswordHasherInterface $passwordHasher): Response
    {
        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setUpdatedAt(new DateTimeImmutable());

            $clearPassword = $request->request->get('user')['password']['first'];
            // si un mot de passe a été saisi
            if (!empty($clearPassword)) {
                // hashage du mot de passe écrit en clair
                $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
                $user->setPassword($hashedPassword);
            }
           
            $entityManager->flush();

            $this->addFlash('success', "User `{$user->getEmail()}` udpated successfully");

            return $this->redirectToRoute('backoffice_user_browse');
        }

        // le champ mot de passe est différent en update et en ajout
        // on le rajoute au niveau du controleur
        $userForm
            ->remove('password')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'mapped' => false,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ]);

        
        return $this->render('backoffice/user/add.html.twig', [
            'user_form' => $userForm->createView(),
            'user' => $user,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER_ADD")
     */
    public function add(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $userForm = $this->createForm(UserType::class, $user);

       
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);

            $clearPassword = $request->request->get('user')['password']['first'];
           
            if (!empty($clearPassword)) {
                $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
                $user->setPassword($hashedPassword);
            }

            $entityManager->flush();

          
            $this->addFlash('success', "User `{$user->getEmail()}` created successfully");
            return $this->redirectToRoute('backoffice_user_browse');
        }

        return $this->render('backoffice/user/add.html.twig', [
            'user_form' => $userForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER_DELETE")
     */
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "User {$user->getId()} deleted");

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_user_browse');
    }
}
